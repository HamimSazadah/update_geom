<?php
session_start();
error_reporting(1);
ini_set('max_execution_time', 0);
      $pg_host        = "host=xxx.xxxx.com";
      $pg_port        = "port=5432";
      $pg_dbname      = "dbname=gis";
      $pg_credentials = "user=sde password=xxxxx";
      $koneksi = pg_connect("$pg_host $pg_port $pg_dbname $pg_credentials");
	  $table_name = "tbl1";
      

	  $lop = pg_fetch_array(pg_query($koneksi,"select id from $table_name where flag_error is null limit 1"));
	  pg_query($koneksi,"update $table_name set geom=sde.st_geometry(coordinate, 4326) where id = $lop[id]");
		  if($_SESSION['last_id']==$lop['id']){
			  echo pg_last_error($koneksi);
			  pg_query($koneksi,"UPDATE $table_name SET flag_error=1 where id=$lop[id]");
		  }else{
			  echo "$lop[id] OK!";			  
			  pg_query($koneksi,"UPDATE $table_name SET flag_error=0 where id=$lop[id]");
		  }
		  $_SESSION['last_id']=$lop['id'];
	 header("Refresh:0");
?>