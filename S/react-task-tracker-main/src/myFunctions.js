
function insert_info(varconn, dbname, table, row_title, info)
{

	query = "INSERT INTO `table` (`row_title`) VALUES ('info');";

	result = mysqli_query(varconn, query);

}


