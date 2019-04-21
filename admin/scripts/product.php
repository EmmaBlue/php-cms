<?php


function addProduct($title, $desc, $cover, $price, $category){
    //if any error happen in process, whole process stopped

        //1. Build DB connection
        include('connect.php');

        $product_name = htmlentities($title);

        //2. Record image file info
            $product_image_name = $cover['name'];
            $product_image_tmp = $cover['tmp_name'];
            $product_image_type = $cover['type'];
            $product_image_size = $cover['size'];
            $product_image_error = $cover['error'];

        //3. Validate file
        $file_type = strtolower(pathinfo($product_image_name, PATHINFO_EXTENSION));
        $accepted_types = array('gif','jpg','jpe','jpeg','png');
        if(!in_array($file_type, $accepted_types)){
            throw new Exception('Wrong file type!');
        }

        //4. Check if there's an error

        if ($product_image_error !== 0) {
            throw new Exception('File too big');
        }

        //5. Give file a unique name

        $product_image = time() . '_' . rand(1000, 9999) . "." . $file_type;

        //6. Resize image to be efficient size
        $target_path = '../images/thumbnails';
        $props = getimagesize($product_image_tmp);
        $imageType = $props[2];
        //Resize image depending on image type
        switch ($imageType) {
            case IMAGETYPE_PNG:
                $imageID = imagecreatefrompng($product_image_tmp);
                $targetLayer = resize($imageID, $props[0], $props[1]);
                imagepng($targetLayer, $target_path. "th_" . $product_image);
                $product_resized = "th_" . $product_image;
                break;
            case IMAGETYPE_GIF:
                $imageID = imagecreatefromgif($product_image_tmp);
                $targetLayer = resize($imageID, $props[0], $props[1]);
                imagegif($targetLayer, $target_path. "th_" . $product_image);
                $product_resized = "th_" . $product_image;
                break;
            case IMAGETYPE_JPEG:
                $imageID = imagecreatefromjpeg($product_image_tmp);
                $targetLayer = resize($imageID, $props[0], $props[1]);
                imagejpeg($targetLayer, $target_path. "th_" . $product_image);
                $product_resized = "th_" . $product_image;
                break;
            default:
                echo "This image type is not allowed.";
                exit;
                break;
        }


        //7. Move file

        move_uploaded_file($product_image_tmp, "../images/$product_image");

        $product_description = htmlentities($desc);

        //4. Add entries to database

        $create_product_query = 'INSERT INTO tbl_product(product_name, product_description, product_image, product_price) VALUES(:title, :desc, :cover, :price)';
        $create_product_set = $pdo->prepare($create_product_query);
        $create_product_set->execute(
            array(
                ':title'=>$product_name,
                ':desc' => $product_description,
                ':cover'=>$product_image,
                ':price'=>$price,
            )
        );

        //grab new product id
        $new_product = $pdo->lastInsertId();

        $create_product_link_query = 'INSERT INTO tbl_product_category(product_id, category_id) VALUES(:product, :category)';
        $create_product_link_set = $pdo->prepare($create_product_link_query);
        $create_product_link_set->execute(
            array(
                ':product'=>$new_product,
                ':category'=>$category
            )
        );

        if(!$create_product_link_set->rowCount()){
            throw new Exception('Failed to see category!');
        }

        //5. If all above works, redirect user to index.php
        redirect_to('index.php');

}

function editProduct($cover, $title, $desc, $price, $category)
{

        include 'connect.php';

        if (isset($_POST['product'])) {
          $id = $_POST['product'];
        }
        $product_name = htmlentities($title);
        //1. Record image file info
        $product_image_name = $cover['name'];
        $product_image_temp = $cover['tmp_name'];
        $product_image_size = $cover['size'];
        $product_image_error = $cover['error'];
        $product_image_type = $cover['type'];
        // 2. check file type
        $file_type = strtolower(pathinfo($product_image_name, PATHINFO_EXTENSION));
        $accepted_types = array('gif','jpg','jpe','jpeg','png');
        if(!in_array($file_type, $accepted_types)){
            throw new Exception('Wrong file type!');
        }
        // 3. check if error
        if ($product_image_error !== 0) {
            throw new Exception('Error in uploading, file size can be too big!');
        }
        // 3. create unique file name
        $product_image = time() . '_' . rand(1000, 9999) . "." . $file_type;
        // 4. resize image
        $target_path = "../images/thumbnails/";
        $props = getimagesize($product_image_temp);
        $imageType = $props[2];
        //Resize image depending on image type
        switch ($imageType) {
            case IMAGETYPE_PNG:
                $imageID = imagecreatefrompng($product_image_temp);
                $targetLayer = resize($imageID, $props[0], $props[1]);
                imagepng($targetLayer, $target_path . "th_" . $product_image);
                $product_resized_image = "th_" . $product_image;
                break;
            case IMAGETYPE_GIF:
                $imageID = imagecreatefromgif($product_image_temp);
                $targetLayer = resize($imageID, $props[0], $props[1]);
                imagegif($targetLayer, $target_path . "th_" . $product_image);
                $product_resized_image = "th_" . $product_image;
                break;
            case IMAGETYPE_JPEG:
                $imageID = imagecreatefromjpeg($product_image_temp);
                $targetLayer = resize($imageID, $props[0], $props[1]);
                imagejpeg($targetLayer, $target_path . "th_" . $product_image);
                $product_resized_image = "th_" . $product_image;
                break;
            default:
                echo "This image type is not accepted.";
                exit;
                break;
        }
        // Move image to right folder
        move_uploaded_file($product_image_temp, "../images/$product_image");
        $product_content = htmlentities($desc);
        $set_product_query = "UPDATE tbl_product SET product_name = :product_name, product_description = :product_description, product_image =  :product_image, product_price = :product_price WHERE product_id = :product_id ";
        $set_product = $pdo->prepare($set_product_query);
        $set_product->execute(
          array(
            ':product_name' => $title,
            ':product_description' => $product_content,
            ':product_price' => $price,
            ':product_image' => $product_image,
            ':product_id' => $id,
          )
        );
        if (!$set_product) {
          throw new Exception('Failed to update product!');
        }

        $insert_category_query = "UPDATE tbl_product_category SET category_id = :category_id WHERE product_id = :product_id";
        $insert_category = $pdo->prepare($insert_category_query);
        $insert_category->execute(
            array(
                ':product_id' => $id,
                ':category_id' => $category
            )
        );
        if (!$insert_category) {
            throw new Exception('Failed to set Category!');
        }
        //5. If all of above works fine, redirect user to index.php
        redirect_to('index.php');

}

function deleteProduct($id) {
    include('connect.php');
     $delete_product_query = 'DELETE FROM tbl_product WHERE product_id = :id';
     $delete_product_set = $pdo->prepare($delete_product_query);
     $delete_product_set->execute(
         array(
                ":id"=> $id
         )
        );

    //grab new movie id
     $product = $pdo->lastInsertId();

    $delete_product_link_query = 'DELETE FROM tbl_product_category WHERE product_id = :id';
    $delete_product_link_set = $pdo->prepare($create_product_link_query);
    $delete_product_link_set->execute(
            array(
                ':product'=>$product,
                ':category'=>$category,
                ":id"=> $id
            )
        );


    if($delete_product_set->rowCount()){
        redirect_to('../index.php');
    } else {
        $message = 'Error with deleting...';
        return $message;
    }


}

