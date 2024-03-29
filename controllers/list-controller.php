<?php 
function listRender() {
    $html_title = 'List'; 
    $page_title = 'Les jouets'; 
    $list_url = "PATH_ROOT . 'views' . SLASH . 'list.php'";

    $games = getAllGames();
    $brands = getByBrand();
    // var_dump($brands);

    $toys = !isset($_GET['brand']) ? $games : $brands;

    // error control
    if(!$toys && isset($_GET['brand'])){
        var_dump($toys);
        echo'miau';
        header( 'Location: /error');    
    }

    // redirection to /list
    if( isset($_GET['brand']) && $_GET['brand'] === 'choose-a-brand' ){
        header( 'Location: /list'); 
    }

    require_once PATH_ROOT . 'views' . SLASH . 'includes' . SLASH . 'header.php';
    require_once PATH_ROOT . 'views' . SLASH . 'list.php';
    require_once PATH_ROOT . 'views' . SLASH . 'includes' . SLASH . 'footer.php';
}

// get all toys of each brand
function getByBrand() {
    global $mysqli;
    
    $brand_list = [];
    
    if( !empty( $_GET['brand']) ) {

        $q_prep = 'SELECT id, name, price, image
                    FROM toys
                    WHERE brand_id=?';

        if( $stmt = mysqli_prepare( $mysqli, $q_prep ) ) {
            if (isset($_GET['brand'] ) ) {
                $brand = $_GET['brand'];
            }
    
            if( mysqli_stmt_bind_param( $stmt, 's', $brand) ) {
                mysqli_stmt_execute( $stmt );
    
                $result = mysqli_stmt_get_result( $stmt );
    
                mysqli_stmt_close( $stmt );
    
                if( $result ) {
                    while( $toys = mysqli_fetch_assoc( $result ) ) {
                        $brand_list[] = $toys;
                    }
                };
            }
        }
    }
    return $brand_list;
}

// get name, price, image and id of each toy
function getAllGames() {
    global $mysqli;
    
    $games_list = [];
    
    $q = 'SELECT name, price, image, id FROM toys ORDER BY price ASC' ;
    
    $q_list = mysqli_query( $mysqli, $q );
    // var_dump($q);
        
        if( $q_list ) {
            while( $game = mysqli_fetch_assoc( $q_list ) ) {

                $games_list[] = $game;
                // var_dump($games_list);
            }
        }
        // var_dump($games_list);
        return $games_list;
}
