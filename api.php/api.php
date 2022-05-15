<?php
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json, charset=utf-8');
header("Content-Type:application/json");
include('conn.php');
$request_method = $_SERVER["REQUEST_METHOD"];



function getArticles()
{
    global $con;
    $query = "SELECT id, Image, Title, Introduction, LastMod, theme.IdTheme, theme.categorie , article.IdTheme  FROM theme , article WHERE theme.IdTheme=article.IdTheme";
    $result = mysqli_query($con,$query);

    $emparray = array();
    
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }
    echo json_encode($emparray);    
}

function getArticle($id=0)
{
    global $con;
    $query = "SELECT id, Image, Title, Introduction, LastMod, theme.IdTheme, theme.categorie , article.IdTheme  FROM theme , article WHERE theme.IdTheme=article.IdTheme";
    if($id != 0)
    {
        $query .= " WHERE id=".$id." LIMIT 1";
    }
    $response = array();
    $result = mysqli_query($con, $query);
    
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
        $id = $row['id'];
        $response["article$id"] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
}

switch($request_method)
	{
		
		case 'GET':
			// Retrive Articles
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				getArticle($id);
			}
			else
			{
				getArticles();
			}
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
			


	}