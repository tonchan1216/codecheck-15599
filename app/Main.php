<?php namespace Codecheck;

function run ($argc, $argv)
{
	if (len($argv) >0) { 
	  foreach ($argv as $index=>$value) {
	    // printf("argv[%s]: %s\n", $index, $value);
	    $base_url = 'http://challenge-server.code-check.io/';
			$q = $value;

			$curl = curl_init();

			// curlの設定
			curl_setopt($curl, CURLOPT_URL, $base_url.'api/hash?q='.htmlspecialchars($q));
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  

			//APIから結果を入手
			$response = curl_exec($curl);
			$result = json_decode($response, true);
			$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			curl_close($curl);

			//ステータスコードで条件分岐
			if ($http_status != '200') {
				printf("Ooops, there is a glitch...");	
			} else {
				printf("%s\n",$result['hash']);
			}
	  }
	} else {
		print("Please input something")
	}
}
