<?php

namespace Model;

class Post
{

    public static function checkReg($name, $role)
    {
        //To check whether he/she is registered or not
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT salt from client_admin WHERE role = ? AND name = ?");
        $stmt->execute([$role, $name]);
        $result = $stmt->fetch();
        $salt = $result[0];
        return $salt;
    }

    public static function checkRegPost($name, $hash, $role)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT name from client_admin WHERE role = ? AND name = ? AND hash = ?");
        $stmt->execute([$role, $name, $hash]);
        $final = $stmt->fetch();
        return $final;
    }

    public static function check($name, $role)
    {
        //Pre-registration check to ensure unique username
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT name from client_admin WHERE role = ? AND name = ?");
        $stmt->execute([$role, $name]);
        $result = $stmt->fetch();
        return $result;
    }

    public static function insert($name, $password, $role, $salt, $hash)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO client_admin (name, hash, salt, role) VALUES(?,?,?,?)");
        $stmt->execute([$name, $hash, $salt, $role]);
        $stmt = $db->prepare("INSERT INTO total_amt (name,fees) VALUES(?,?)");
        $stmt->execute([$name, 0]);
    }

    public static function insertAdminReg($name, $password, $role, $salt, $hash)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO admin_registration (name, hash, salt) VALUES(?,?,?)");
        $stmt->execute([$name, $hash, $salt]);
    }

    public static function getAll()
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT book_name, isbn, author FROM books");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function getAllReq()
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT requests.name, requests.isbn, books.book_name from requests inner join books on books.isbn = requests.isbn");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function getAllReg()
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT name FROM admin_registration");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function getAllSp($name)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT book_name, author FROM books where qty_left>0 AND isbn NOT IN (SELECT isbn from books_user where name = ? union all select isbn from requests where name = ? )");
        $stmt->execute([$name, $name]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function book($isbn)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT book_name, author, isbn FROM books WHERE isbn = ?");
        $stmt->execute([$isbn]);
        $row = $stmt->fetch();
        return $row;
    }

    public static function addBook($name, $auth, $qty)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT qty, qty_left FROM books WHERE book_name = ?");
        $stmt->execute([$name]);
        $result = $stmt->fetch();
        return $result;
    }

    public static function addBookOnResNull($name, $auth, $qty, $isbn)
    {
        $db = \DB::get_instance();
        $stmt2 = $db->prepare("INSERT INTO books (isbn, book_name, author, qty, qty_left ) VALUES(?,?,?,?,?)");
        $stmt2->execute([$isbn, $name, $auth, $qty, $qty]);
    }

    public static function addBookQtyInc($name, $qty, $qty_left)
    {
        $db = \DB::get_instance();
        $stmt2 = $db->prepare("UPDATE books SET qty = ?, qty_left = ? WHERE book_name = ?");
        $stmt2->execute([$qty, $qty_left, $name]);
    }

    public static function deleteBook($name)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT isbn FROM books WHERE book_name = ?");
        $stmt->execute([$name]);
        $result = $stmt->fetch();
        $TEMP = $result[0];
        $stmt = $db->prepare("DELETE FROM books WHERE isbn = ?");
        $stmt->execute([$TEMP]);
        $stmt = $db->prepare("DELETE FROM books_user WHERE isbn = ?");
        $stmt->execute([$TEMP]);
        $stmt = $db->prepare("DELETE FROM requests WHERE isbn = ?");
        $stmt->execute([$TEMP]);
    }

    public static function checkReq($isbn, $name, $time)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("DELETE FROM requests WHERE isbn = ?");
        $stmt->execute([$isbn]);
        $stmt2 = $db->prepare("INSERT INTO books_user (isbn, name ) VALUES(?,?)");
        $stmt2->execute([$isbn, $name]);
        $stmt2 = $db->prepare("INSERT INTO fees (isbn, name, in_time ) VALUES(?,?,?)");
        $stmt2->execute([$isbn, $name, $time]);
    }

    public static function checkReqD($isbn, $name)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("DELETE FROM requests WHERE isbn = ?");
        $stmt->execute([$isbn]);
        $stmt3 = $db->prepare("SELECT qty_left FROM books WHERE isbn = ?");
        $stmt3->execute([$isbn]);
        $res = $stmt3->fetch();
        return $res[0];
    }

    public static function checkReqDUpdateQty($isbn, $qty_left)
    {
        $db = \DB::get_instance();
        $stmt2 = $db->prepare("UPDATE books SET qty_left = ? WHERE isbn = ?");
        $stmt2->execute([$qty_left, $isbn]);
    }

    public static function regApproval($name)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT hash, salt FROM admin_registration WHERE name = ?");
        $stmt->execute([$name]);
        $result = $stmt->fetch();
        $hash = $result[0];
        $salt = $result[1];
        $role = 'admin';
        $stmt = $db->prepare("DELETE FROM admin_registration WHERE name = ?");
        $stmt->execute([$name]);
        $stmt = $db->prepare("INSERT INTO client_admin (name, hash, salt, role) VALUES(?,?,?,?)");
        $stmt->execute([$name, $hash, $salt, $role]);
    }

    public static function regDisapproval($name)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("DELETE FROM admin_registration WHERE name = ?");
        $stmt->execute([$name]);
    }

    public static function addCheckOutReq($name, $isbn)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO requests (name, isbn) VALUES(?,?)");
        $stmt->execute([$name, $isbn]);
        $stmt3 = $db->prepare("SELECT qty_left FROM books WHERE isbn = ?");
        $stmt3->execute([$isbn]);
        $res = $stmt3->fetch();
        return $res[0];
    }

    public static function decQtyOnCheckOutReq($qty_left, $isbn)
    {
        $db = \DB::get_instance();
        $stmt2 = $db->prepare("UPDATE books SET qty_left = ? WHERE isbn = ?");
        $stmt2->execute([$qty_left, $isbn]);
    }

    public static function urBk($name)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT books.book_name, books.author, books.isbn from books inner join books_user on books_user.isbn = books.isbn where books_user.name = ?");
        $stmt->execute([$name]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function checkInApp($name, $isbn)
    {
        //Automatically done
        $db = \DB::get_instance();
        $stmt = $db->prepare("DELETE FROM books_user WHERE  isbn = ? AND name = ?");
        $stmt->execute([$isbn, $name]);
        $stmt3 = $db->prepare("SELECT qty_left FROM books WHERE isbn = ?");
        $stmt3->execute([$isbn]);
        $res = $stmt3->fetch();
        return $res[0];
    }

    public static function incQtyCheckInApp($name, $isbn, $qty_left)
    {
        $db = \DB::get_instance();
        $stmt2 = $db->prepare("UPDATE books SET qty_left = ? WHERE isbn = ?");
        $stmt2->execute([$qty_left, $isbn]);
        $stmt2 = $db->prepare("SELECT in_time FROM fees WHERE isbn = ? AND name = ?");
        $stmt2->execute([$isbn, $name]);
        $res = $stmt2->fetch();
        return $res[0];
    }

    public static function feesPostCheckIn($name, $isbn, $fees, $time)
    {
        $db = \DB::get_instance();
        $stmt2 = $db->prepare("UPDATE fees SET out_time = ?, fees = ? WHERE isbn = ? AND name = ?");
        $stmt2->execute([$time, $fees, $isbn, $name]);
        $stmt2 = $db->prepare("SELECT fees FROM total_amt WHERE name = ?");
        $stmt2->execute([$name]);
        $res = $stmt2->fetch();
        return $res[0];
    }

    public static function updateFeesOnCheckIn($name, $fees)
    {
        $db = \DB::get_instance();
        $stmt2 = $db->prepare("UPDATE total_amt SET fees = ? WHERE name = ?");
        $stmt2->execute([$fees, $name]);
    }
    
    public static function feesFound($name)
    {
        $db = \DB::get_instance();
        $stmt3 = $db->prepare("SELECT fees FROM total_amt WHERE name = ?");
        $stmt3->execute([$name]);
        $res = $stmt3->fetch();
        return $res;
    }
}
