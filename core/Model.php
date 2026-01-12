 <?php
 if(!defined('_HIENU')){  //nếu hằng sô không đúng thì error
    die('Truy cập không hợp lệ');
 }

 //Hàm truy vấn tất cả dữ liệu
function getALL($sql){
   global $conn;
   $stm = $conn -> prepare($sql); //prepare hàm để lọc dữu liệu
   $stm -> execute();
   $result = $stm -> fetchALL(PDO::FETCH_ASSOC);
   return $result;
}  

//Đếm số dòng trả về 
function getRows($sql){
   global $conn;
   $stm = $conn -> prepare($sql); //prepare hàm để lọc dữu liệu
   $stm -> execute();
   return $stm -> rowCount();;
}

//Truy vấn 1 dòng dữ liệu 
function getOne($sql){
   global $conn;
   $stm = $conn -> prepare($sql); //prepare hàm để lọc dữu liệu
   $stm -> execute();
   $result = $stm -> fetch(PDO::FETCH_ASSOC);
   return $result;
}   

//Insert database 
function insert($table, $data){
   global $conn;
   $keys = array_keys($data);   //lấy dữ liệu về dạng array
   $cot = implode(',', $keys);       //chuyển dữ liệu từ dạng array sang dạng chuổi
   $place = ':'.implode(',:', $keys);
   
   $sql= "INSERT INTO $table ($cot) VALUES($place)";
   $stm = $conn -> prepare($sql);   //SQL Injection
   
   //Thực thi câu lệnh
   $rel = $stm -> execute($data);   
   return $rel;
}

function update($table, $data, $condition = ''){
   global $conn;
   $update = '';
   foreach($data as $key => $value){
      $update .= $key . '=:' .$key;  
   }

   $update = trim($update, ',');

   if(!empty($condition)){
      $sql = "UPDATE $table SET $update WHERE $condition";
   }else {
      $sql = "UPDATE $table set $update";
   }
   $tmp = $conn -> prepare($sql);
   $rel = $tmp -> execute($data);
   return $rel;
} 

function delete($table, $condition = ''){
   global $conn;
   if(!empty($condition)){
      $sql = "DELETE FROM $table WHERE $condition";
   }else {
      $sql = "DELETE FROM $table";
   }
   $stm = $conn -> prepare($sql);
   $rel = $stm -> execute();
   return $rel;
}


//Hàm lấy dữ liệu mới insert
function lastID(){
   global $conn;
   return $conn -> lastInsertID();
}

