<?php




if(isset($_POST['submit'])){
    $total = count($_FILES['fileUpload']['tmp_name']);
    for($i=0;$i<$total;$i++){
      $fileName = $_FILES['fileUpload']['name'][$i];
      $ext = pathinfo($fileName, PATHINFO_EXTENSION);
      $newFileName = md5(uniqid());
      $fileDest = 'filesUploaded/'.$newFileName.'.'.$ext;
      $justFileName = $newFileName.'.'.$ext;
      if($ext === 'pdf' || 'jpeg' || 'JPG'){
          move_uploaded_file($_FILES['fileUpload']['tmp_name'][$i], $fileDest);
          $this->fileName = array($justFileName);
          $this->encodedFileNames = serialize($this->fileName);
          var_dump($this->encodedFileNames);
      }else{
        echo $fileName . ' Could not be uploaded. Pdfs and jpegs only please';
      }
    }

 $sql = "INSERT INTO reminders (exdate, name, category, location, fileUpload, notes) VALUES (:exdate,:name,:category,:location,:fileName,:notes)";
 $stmt = $this->connect()->prepare($sql);
 $stmt->bindParam(':exdate', $this->exdate);
 $stmt->bindParam(':name', $this->name);
 $stmt->bindParam(':category', $this->category);
 $stmt->bindParam(':location', $this->location);
 $stmt->bindParam(':fileName', $this->encodedFileNames);
 $stmt->bindParam(':notes', $this->notes);
 $stmt->execute();
}

}catch(PDOException $e){
echo $e->getMessage();
}
}
}