<?php

class Controller {
	protected const CLIENT_ID = "OTe7e3tbBL";
	protected const SEARCH_ROUTE = "https://api.boardgameatlas.com/api/search";
	const PARAM_CLIENT_ID = "client_id";
	const PARAM_LIMIT = "limit";
	const PARAM_RANDOM = "random";
	const FIELD_IMAGE = "image_url";
	const FIELD_NAME = "name";

	// todo be the same for everyone, reset at midnight
	protected $_todayGame;

	protected function _callApi() {
		$curl = curl_init();

		$param = [
			self::PARAM_CLIENT_ID => self::CLIENT_ID,
			self::PARAM_LIMIT => 1,
			self::PARAM_RANDOM => "true"
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

	public function fetchGame() {
		$result = $this->_callApi();
		include "view/game.php";
	}

	public function getGameName() {
		return $this->_todayGame[self::FIELD_NAME];
	}

	public function getGameImage() {
		return $this->_todayGame[self::FIELD_IMAGE];
	}
}