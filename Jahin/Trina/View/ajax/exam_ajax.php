<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['json'])) {
    $data = $_POST['json'];
    $examData = json_decode($data);
    echo ($examData->exam_title ?? 'No exam title received') . ' - Set Done';
    exit;
}
?>

<!DOCTYPE html>
<html>
<body>
    <label for="examTitle">Enter Exam:</label><br>
    <input type="text" id="examTitle" placeholder="Enter exam title">
    <button onclick="sendData()">Submit</button>
    <div id="result"></div>

    <script>
    function sendData() {
        const examTitle = document.getElementById('examTitle').value;
        const xhr = new XMLHttpRequest();
        
        xhr.open('POST', 'exam_ajax.php');
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        xhr.onload = function() {
            document.getElementById('result').textContent = this.responseText;
        };
        
        xhr.send('json=' + JSON.stringify({
            exam_title: examTitle
        }));
    }
    </script>
</body>
</html>

<?php
// File upload handling
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['myfile'])) {
    $file = $_FILES['myfile'];
    
    if($file['error'] === UPLOAD_ERR_OK) {
        // Create upload directory if it doesn't exist
        if(!is_dir('upload')) {
            mkdir('upload', 0777, true);
        }
        
        $src = $file['tmp_name'];
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $des = __DIR__.'/upload/abc.'.$ext;  // Use absolute path
        
        if(move_uploaded_file($src, $des)) {
            echo "Success";
        } else {
            echo "Error moving file";
        }
    } else {
        echo "Error uploading file (Code: ".$file['error'].")";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Uploads</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        Image: <input type="file" name="myfile">
        <input type="submit" value="Upload">
    </form>
</body>
</html>