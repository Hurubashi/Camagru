<?php


class PhotoMakerModel
{

    public function saveImage() {
        $imgData = str_replace(' ','+',$_POST['image']);
        $imgData =  substr($imgData,strpos($imgData,",")+1);
        $imgData = base64_decode($imgData);
        // Path where the image is going to be saved
        $filename = uniqid(rand(), true) . '.png';
        $filePath = '/components/photoLibrary/' . $filename;

        // Write $imgData into the image file
        $file = fopen( (ROOT . $filePath), 'w');
        fwrite($file, $imgData);
        fclose($file);

        $this->addToDB($_SESSION['id'], $_SESSION['username'], $filePath);
    }

    private function addToDB($userId, $username, $imagePath) {
        if (Database::pdo_is_connected()) {
            $sql = "INSERT INTO photo (ownerId, username, photoURL) 
                    VALUES (:ownerId, :username, :photoURL)";
            $stmt = Database::$pdo->prepare($sql);

            $stmt->execute(['ownerId' => $userId,
                'username' => $username, 'photoURL' => $imagePath]);

        }
    }
}