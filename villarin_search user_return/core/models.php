<?php  

require_once 'dbConfig.php';

function getAllUsers($pdo) {
	$sql = "SELECT * FROM search_users_data 
			ORDER BY first_name ASC";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getUserByID($pdo, $id) {
	$sql = "SELECT * from search_users_data WHERE id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function searchForAUser($pdo, $searchQuery) {
	
	$sql = "SELECT * FROM search_users_data WHERE 
			CONCAT(first_name,last_name,email,gender,
				address,specialization,achievements,years_of_experience,date_added) 
			LIKE ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute(["%".$searchQuery."%"]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}



function insertNewUser($pdo, $first_name, $last_name, $email, 
	$gender, $address, $specialization, $achievements, $years_of_experience) {

	$sql = "INSERT INTO search_users_data 
			(
				first_name,
				last_name,
				email,
				gender,
				address,
				specialization,
				achievements,
				years_of_experience
			)
			VALUES (?,?,?,?,?,?,?,?)
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([
		$first_name, $last_name, $email, 
		$gender, $address, $specialization, 
		$achievements, $years_of_experience,
	]);

	if ($executeQuery) {
		return true;
	}

}

function editUser($pdo, $first_name, $last_name, $email, $gender, 
	$address, $specialization, $achievements, $years_of_experience, $id) {

	$sql = "UPDATE search_users_data
				SET first_name = ?,
					last_name = ?,
					email = ?,
					gender = ?,
					address = ?,
					specialization = ?,
					achievements = ?,
					years_of_experience = ?
				WHERE id = ? 
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, $email, $gender, 
		$address, $specialization, $achievements,$years_of_experience, $id]);

	if ($executeQuery) {
		return true;
	}

}


function deleteUser($pdo, $id) {
	$sql = "DELETE FROM search_users_data 
			WHERE id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$id]);

	if ($executeQuery) {
		return true;
	}
}




?>