<?php
// http://www.re-cycledair.com/php-dark-arts-semaphores
	//Using a semaphore to control access to stdin.

	//Semaphore properties
	$key = 123456;
	$max = 1;
	$permissions = 0666;
	$autoRelease = 1;

	//Open a new or get an existing semaphore
	$semaphore = sem_get($key, $max, $permissions, $autoRelease);
	if(!$semaphore) {
		echo "Failed on sem_get().\n";
		exit;
	}

	//Try to aquire the semaphore.
	for($i = 0; $i < 2; $i++) {
		echo "\nAttempting to acquire semaphore...\n";
		$hasAcquired = sem_acquire($semaphore, true);
		
		echo "Aquired:";
		var_dump($hasAcquired);

		if ($hasAcquired)
		{
			echo "Enter some text: ";
			$handler = fopen("php://stdin", "r");
			$text = fgets($handler);
			
			fclose($handler);
			sem_release($semaphore);
			
			echo "Got: $text \n";
		}
	}
?>
