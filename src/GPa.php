<?php
namespace GPa;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
class GPa {
	private static function senddata($meth = 'get', $uri = '', $data = [], $h = []) {
		$h['content-type'] = 'application/json';
		$http = Http::withHeaders($h);
		$url = "https://gpa.one/api/integration/".$uri;
		try {
			if (strtolower($meth) == "get") {
				$response = $http->withQueryParameters($data)->get($url);
			}
			if (strtolower($meth) == "put") {
				$response = $http->put($url, $data);
			}
			if ($response->ok() && is_array($response->json())) {
				return $response->json();
			}else{
				return ['error' => 'not found'];
			}
		}catch(\Exception $e) {
			return ['error' => 'Connection invalid'];
		}
		return ["error" => 'Unable to connect'];
	}
	public static function isPrem($uuid) {
		$r = self::senddata('put', 'isprem', ['uuid' => $uuid]);
		if (array_key_exists('isprem', $r) && $r['isprem'] == "true") {
			return true;
		}
		return false;
	}
	public static function isBanned($uuid) {
		$r = self::senddata('put', 'isbanned', ['uuid' => $uuid]);
		if (array_key_exists('isbanned', $r) && $r['isbanned'] == "true") {
			return true;
		}
		return false;
	}
}