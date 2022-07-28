<?php

class Controller {
	protected const CLIENT_ID = "OTe7e3tbBL";
	protected const SEARCH_ROUTE = "https://api.boardgameatlas.com/api/search";
	const PARAM_CLIENT_ID = "client_id";
	const PARAM_LIMIT = "limit";
	const PARAM_RANDOM = "random";
	const FIELD_IMAGE = "image_url";
	const FIELD_NAME = "name";
	const FIELD_ID = "id";
	const FIELD_FIELDS = "fields";

	const TABLE_HISTORY = "history";
	const DB_ID = "id";
	const DB_NAME = "name";
	const DB_GAME_ID = "game_id";
	const DB_IMAGE = "image";
	const DB_DATE = "date";

	protected $connectedToDb = true;
	protected $connection;

	// todo be the same for everyone, reset at midnight
	protected $_todayGame;
	protected $_currentId;

	public function __construct()
    {
        $config = json_decode(file_get_contents("configuration/config.json"), true);

        $this->connection = new mysqli($config["host"], $config["user"], $config["password"], $config["database"]);

        if ($this->connection->connect_error) {
            $this->connectedToDb = false;
        }
    }

    protected function _callApi() {
		$curl = curl_init();

		$param = [
			self::PARAM_CLIENT_ID => self::CLIENT_ID,
			self::PARAM_LIMIT => 1,
			self::PARAM_RANDOM => "true",
            self::FIELD_FIELDS => implode(",", [self::FIELD_NAME, self::FIELD_IMAGE, self::FIELD_ID])
		];


		try {
			$curl = curl_init();

			if ($curl === false) {
				throw new Exception('failed to initialize');
			}


			$url = sprintf("%s?%s", self::SEARCH_ROUTE, http_build_query($param));

			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

			$result = curl_exec($curl);

			if ($result === false) {
				throw new Exception(curl_error($curl), curl_errno($curl));
			}

			$httpReturnCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

			$resultArr = json_decode($result, true);

			if (!empty($resultArr["games"])) {
				$this->_todayGame = $resultArr["games"][0];
			}

			curl_close($curl);

			return $this->_todayGame;

		} catch(Exception $e) {

			trigger_error(sprintf(
				'Curl failed with error #%d: %s',
				$e->getCode(), $e->getMessage()),
			E_USER_ERROR);

		} finally {
			if (is_resource($curl)) {
				curl_close($curl);
			}
		}
	}

	protected function _selectDb($fileds = "*", $table = self::TABLE_HISTORY, $where = null) {
	    if (is_array($fileds)) {
	        $fileds = implode(", ", $fileds);
	    }
        $sql = "SELECT ". $fileds ." FROM ". $table;

	    if (!empty($where)) {
	        $whereStatement = "WHERE ";
	        foreach ($where as $field => $condition) {
                $whereStatement .= $field . " " . array_keys($condition)[0] . " '" . array_values($condition)[0] ."'";
            }
        }

        $sql .= " " . $whereStatement;

        $result = $this->connection->query($sql);
        return $result->fetch_assoc();
	}

	protected function _insertDb($table, $data) {
	    if (!empty($data) && is_array($data)) {
	        $sql = "INSERT INTO " . $table
                . " (`" . implode("`, `", array_keys($data)) . "`) "
                . "VALUES ('" . implode("', '", array_values($data)) . "')";

            $result = $this->connection->query($sql);
            if ($result) {
                $this->_currentId = $this->connection->insert_id;
            }
        }
    }

	protected function getTodayGameIfExist() {
	    $this->_todayGame = $this->_selectDb(
	        [self::DB_ID, self::DB_NAME, self::DB_IMAGE],
            self::TABLE_HISTORY,
            [self::DB_DATE => ["=" => date("Y-m-d")]]
        );

        $this->_currentId = $this->_todayGame[self::DB_ID];

	    return $this->_todayGame;
    }

	public function fetchGame($daily = false) {
	    if ($daily) {
            $this->getTodayGameIfExist();
        }

	    if (empty($this->_todayGame)) {
            $game = $this->_callApi();
            if ($daily) {
                $this->_insertDb(self::TABLE_HISTORY,
                    [
                        self::DB_NAME => $game[self::FIELD_NAME],
                        self::DB_IMAGE => $game[self::FIELD_IMAGE],
                        self::DB_GAME_ID => $game[self::FIELD_ID],
                        self::DB_DATE => date("Y-m-d")
                    ]
                );
            }
        }

		include "view/game.php";
	}

	public function getGameName() {
		return $this->_todayGame[self::FIELD_NAME];
	}

	public function getGameImage() {
	    if (array_key_exists(self::FIELD_IMAGE, $this->_todayGame)) {
            return $this->_todayGame[self::FIELD_IMAGE];
        }

        return $this->_todayGame[self::DB_IMAGE];
    }

    public function getGuessId() {
	    return $this->_currentId;
    }
}