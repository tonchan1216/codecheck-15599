<?php namespace Codecheck;

function run ($argc, $argv)
{
  foreach ($argv as $index=>$value) {
    // printf("argv[%s]: %s\n", $index, $value);
    $base_url = 'http://challenge-server.code-check.io/';
		$q = $value;

		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $base_url.'api/hash?q='.$q);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // curl_execの結果を文字列で返す

		$response = curl_exec($curl);
		$result = json_decode($response, true);
		$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);

		if ($http_status != '200') {
			printf("Ooops, there is a glitch...");	
		} else {
			printf("%s",var_dump($response));
		}
  }
}
