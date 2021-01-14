<?php
    $filePath = "./files/" . $_FILES["csvFile"]["name"];

    if (move_uploaded_file($_FILES["csvFile"]["tmp_name"], $filePath))
    {
        chmod($filePath, 0644); // ファイルアップロード成功
    }else{
        // ファイルアップロード失敗
        echo '失敗';
    }

    $objFile = new SplFileObject($filePath);
    $objFile->setFlags(SplFileObject::READ_CSV);
    $objFile->setCsvControl("\t" /* 区切り文字 */, "\"" /* 囲い文字 */);

    foreach ($objFile as $key => $line)
    {
        foreach ($line as $buf)
        {
            // $buf = mb_convert_encoding($buf, "UTF-8", "sjis-win");
            $records[$key][] = $buf;
        }
    }
    // echo "<pre>";
    // print_r($records[0]);
    // echo $records;
    // echo "</pre>";



    //2. DB接続します
    include("funcs.php");
    $pdo = dbcons();

    foreach($records as $lines){

        foreach($lines as $line){
            $data = explode(',',$line);
        
            // echo '<p>';
            // echo ' No.',$data[0];
            // echo ' 商品名：',$data[1];
            // echo ' 単価：',$data[2];	
            // echo '</p>';

            $name = $data[0];
            $email = $data[1];
            $age = $data[2];
            $naiyou = $data[3];
            
            //３．データ登録SQL作成
            $stmt = $pdo->prepare("INSERT INTO gs_an_table(name,email,age,naiyou,indate) VALUES(:name,:email,:age,:naiyou,sysdate())");
            $stmt->bindValue(':name',  $name,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
            $stmt->bindValue(':age',   $age,   PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
            $stmt->bindValue(':naiyou',$naiyou,PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
            $status = $stmt->execute();

            //４．データ登録処理後
            if($status==false){
                //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
                $error = $stmt->errorInfo();
                exit("SQLError:".$error[2]);
            }
        }
    }

    foreach (glob("./files/*.csv") as $delFile) unlink($delFile); // ファイル削除処理

    //５．index.phpへリダイレクト
    header("Location: select.php");
    exit();
?>