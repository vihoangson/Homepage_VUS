<?php



if (!defined('NV_ADMIN')) {

    die ("Access Denied");

}







global $prefix, $db, $adminfile;

$pathvideo="uploads/video/images/";

if ($adminfile == '') { $adminfile = 'admin'; }

if (!eregi("".$adminfile.".php", $_SERVER['PHP_SELF'])) { die ("Access Denied"); }

$aid = substr("$aid", 0,25);

$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM nv92c95_authors WHERE aid='$aid'"));

if ($row['radminsuper'] == 1)

{
	

function gets_video($page=0,$per_page=0,$case="all",$var_gets_product=0){
     global  $prefix,$db;
     if($page==0 && $per_page==0){
          $limit="";     
     }else{
          $limit="limit $page , $per_page";               
     }     
     $langid=get_lang_id();
     //==================================================================== 
     //begin
     $array_sql=array(
          0=>"
				SELECT * from ".$prefix."_video a
				order by a.id desc 
				".$limit."
          ",
          1=>"
				SELECT a.* from ".$prefix."_video a
				where
				 a.user_id = ".$var_gets_product."
				order by a.id desc 
				".$limit."
          ",  
          2=>"
				SELECT * from ".$prefix."_video a
				order by a.id desc 
				".$limit."
          ",     		                      
     );     
     
     switch ($case){
          case "all"://lấy tất cả sản phẩm
               $sql = $array_sql[0];
          break;	    	    
           case "video_of_user"://lấy tất cả sản phẩm
               $sql = $array_sql[1];
          break;	    	             
           case "list_url"://lấy tất cả sản phẩm
               $sql = $array_sql[2];
          break;	
     }
     if($_GET["son"]=="test")
          echo $sql; 
     //end
     //==================================================================== 
     $result = $db->sql_query($sql);
     $data=array();

	 if($case!="list_url"){	 
		 if ($db->sql_numrows($result) != 0){
			  while($row = $db->sql_fetchrow($result)){
				   $data[] = $row;
			  }          
		 }     
	 }else{

		 if ($db->sql_numrows($result) != 0){
			  while($row = $db->sql_fetchrow($result)){
				   $data[] = $row["url"];
			  }          
		 }
	 }
	 
     unset($result,$row);
          
     return $data;
}

function import_youtube(){
	global $db,$prefix;
	include ("../header.php");
	GraphicAdmin();
	newstopbanner();
?>
	<div class="form_import">
		<h3>Import Youtube</h3>
		<form method="post">
			<div>
				<p>Tìm theo user:</p>
					<input type="text" name="txt_user" />
				<p>Tìm theo từ khóa:</p>
					<input type="text" name="txt_keyword" />		
			</div>
			<button class="btn btn-primary" type="submit"> Import Youtube </button>
		</form>
	</div>
<?php

if(sizeof($_POST["box"])>0){
	$txt_theloai=$_POST["txt_theloai"];
	$data_url=gets_video(0,5000,"list_url");		
	for($i=0;$i<sizeof($_POST["box"]);$i++){
		$a_you=explode("___",$_POST["box"][$i]);
		$url=$a_you[0];
		if(!in_array($url,$data_url)){

			$sql="insert into ".$prefix."_video(name,url,id_theloai,tid,user_id) values('".$a_you[1]."','".$a_you[0]."','".$txt_theloai."','1',107)";	
			$db->sql_query($sql);
			echo "<div class='alert alert-success'>Saved - ".$a_you[1]." </div>";
		}else{
			echo "<div class='alert alert-error'>Video bị trùng ".$a_you[1]." [".$a_you[0]."] </div>";	
		}
	}
	
	
}
	if($_POST["txt_user"] || $_POST["txt_keyword"] ){
		if($_POST["txt_user"]){
			$feedURL = "http://gdata.youtube.com/feeds/api/users/".$_POST["txt_user"]."/uploads?star-index=5&max-results=50&start-index=1";
			$sxml = simplexml_load_file($feedURL);    
			$i=1;
			echo "<div class='import_video_result'>
				<form method='post'>
			";
			foreach ($sxml->entry as $entry) {  
				$media = $entry->children('http://search.yahoo.com/mrss/');
				$attrs = $media->group->content->attributes();
				$videoURL = $attrs['url'];
				$videoURL = preg_replace('/\?.*/', '', $videoURL);
				$videoURL = str_replace("/v/","/embed/",$videoURL);    
				$videoTitle = $media->group->title; 
				$idv = str_replace("http://www.youtube.com/embed/","",$videoURL);
				$idv = str_replace("&feature=youtube_gdata","",$idv);				
				$id=$idv;
				$title = $videoTitle;
				$data=array("id"=>$id,"title"=>$title);
				ele_video_import($data);			    
			}
			echo "
				<div class='clearfix'></div>
				<p>
	<select name='txt_theloai'>";

			$sql="select *from ".$prefix."_theloai order by theloai";

			$result=$db->sql_query($sql);

			while($row=$db->sql_fetchrow($result)){
				$theloai=splitcat($row["theloai"]);
				$xid=$row["id"];
				if($idtheloai==$xid)
	    				echo "<option value=\"$xid\" selected=\"selected\">$theloai</option>";
				else
					echo "<option value=\"$xid\" >$theloai</option>";
			}
    	echo "  </select>
				</p>		
				<div class='checkall'>Check all</div>
				<div class='uncheckall'>Uncheck all</div>
				<button class='btn btn-primary'>Import</button>
				</form>
			</div>";
		}
	    
		if($_POST["txt_keyword"]){
		    $feedURL = "http://gdata.youtube.com/feeds/base/videos?q=".$_POST["txt_keyword"]."&client=ytapi-youtube-search&v=2&max-results=50";    
		    $sxml = simplexml_load_file($feedURL);
			echo "<div class='import_video_result'>
				<form method='post'>
			";
		    foreach ($sxml->entry as $item){ 
			 $href = $item->link->attributes()->href;
			 $id=str_replace("http://www.youtube.com/watch?v=","",$href);
			 $id = str_replace("&feature=youtube_gdata","",$id);
			 $title = $item->title;
			 $data=array("id"=>$id,"title"=>$title);
			 ele_video_import($data);
		    }
			echo "
				<div class='clearfix'></div>
				<div class='checkall'>Check all</div>
				<div class='uncheckall'>Uncheck all</div>
				<p>
	<select name='txt_theloai'>";

			$sql="select *from ".$prefix."_theloai order by theloai";

			$result=$db->sql_query($sql);

			while($row=$db->sql_fetchrow($result)){
				$theloai=splitcat($row["theloai"]);
				$xid=$row["id"];
				if($idtheloai==$xid)
	    				echo "<option value=\"$xid\" selected=\"selected\">$theloai</option>";
				else
					echo "<option value=\"$xid\" >$theloai</option>";
			}
    	echo "  </select>				
				</p>				
				<button class='btn btn-primary'>Import</button>
				</form>
			</div>";
		}
	    
	}
	echo "<div class='clearfix'></div>";
	include ("../footer.php");	
}
function ele_video_import($data){
	$id=$data["id"];
	$title=$data["title"];
?>
<div class="ele_video">
	<a href="http://www.youtube.com/watch?v=<?php echo $id ; ?>">
		<img src="http://img.youtube.com/vi/<?php echo $id ; ?>/0.jpg" />
	</a>
	<p><?php echo $title ; ?></p>
	
	<input type="checkbox" class="box_check" name="box[]" value="<?php echo $id ; ?>___<?php echo str_replace("\"","",$title) ; ?>" />
</div>
<?	
}
function newstopbanner() {
	global $adminfile;	
?>
    <ul class="nav nav-pills">
	    <li class="active">
		    <a href="admin.php?op=videohome">Video</a>
	    </li>
	    <li>
		    <a href="admin.php?op=theloai">Chủ đề</a>
	    </li>
	    <li>
		    <a href="admin.php?op=Check_Video">Check Video</a>
	    </li>
	    <li>
		    <a href="admin.php?op=import_youtube">Import Youtube</a>
	    </li>
	    <li>
		    <a href="admin.php?op=them_video">Add new</a>
	    </li>
	    <li>
	    
		    <a href="admin.php?op=videotags">Tags video</a>
	    </li>

    </ul>	
<?php

	

}

function Videohome_m()

{

	global $adminfile, $prefix, $db, $multilingual, $bgcolor2, $Home_Module;

	 include ("../header.php");

	GraphicAdmin();

	newstopbanner();

	 include ("../footer.php");

}
function videotags()

{	

	global $adminfile, $prefix, $db, $multilingual, $bgcolor2, $Home_Module;

if($_POST["save"]=="do"){

		exit;
}

    include ("../header.php");

    GraphicAdmin();

	

   newstopbanner();

   Opentable();

   echo "<div align=\"center\"><b>Danh sách video</b></div>";  
echo "
<form method='get'>
<input type='hidden' name='op' value='videohome'>
<select name='id_theloai_view'>";
	$sql="select *from ".$prefix."_theloai order by theloai";
	$result=$db->sql_query($sql);
	while($row=$db->sql_fetchrow($result)){
		$theloai=splitcat($row["theloai"]);
		$xid=$row["id"];			
		echo "<option value=\"$xid\" >$theloai</option>";	
	}
    	echo "  
</select>
	<p><button class='btn btn-primary' type='submit'>View</button></p>
</form>	
<form method='post'>";
	echo "<table  width=\"100%\" class=\"table_video\">";
	if($_GET["id_theloai_view"]){
		$where_theloai="where id_theloai=".$_GET["id_theloai_view"]." order by id desc ";
	}else{
		$where_theloai=" order by id desc  limit 100 ";
	}	
	$sql="select * from ".$prefix."_video ".$where_theloai." ";

	$result=$db->sql_query($sql);

	$numrow=$db->sql_numrows($result);

	if($numrow!=0){

	while($row=$db->sql_fetchrow($result)){


			echo "<tr>";
			echo "<td >id: ".$row['id']."</td>";
			echo "<td >".$row['name']."</td>";
		   	echo "<td width=\"70\" ><img src=\"http://i1.ytimg.com/vi/".$row['url']."/default.jpg\"></td>";
			//echo "<td  >".splitcat($theloai)." </td>";
	
		  if($row["choice"]!=1){
			echo "<td><a href=\"admin.php?op=Video_Makechoice&id=".$row['id']."&case=1\">Edit</a></td>";
		   }else{
			echo "<td><a href=\"admin.php?op=Video_Makechoice&id=".$row['id']."&case=0\"><b style=\"color:red;font-weight:bold;\">Nên xem</b></a></td>";
		   }
			echo "<td><a href=\"admin.php?op=Video_Edit&amp;id=".$row['id']."\">Edit</a></td>";
	
			echo "<td><a href=\"admin.php?op=Video_Delete&amp;id=".$row['id']."\">Delete </a>  
			";
			
			?>
    <ul id="demo2" class="demo2222"  data-name="demo2">
        <li data-value="here">here</li>
        <li data-value="are">are</li>
        <li data-value="some...">some</li>
        <!-- notice that this tag is setting a different value :) -->
        <li data-value="initial">initial</li>
        <li data-value="tags">tags</li>
    </ul>			
			<?php
			echo "
			</td>";
	
			echo "</tr>";
		}


	echo "</table>";
	
echo "
<button class='btn btn-primary'  type='submit'>Save</button>
</form>";

	}else {

		echo "<center>No videos have been entered into the Database yet</center>";

	}

Closetable();

	

	 include ("../footer.php");

	

}
function Videohome()

{	

	global $adminfile, $prefix, $db, $multilingual, $bgcolor2, $Home_Module;

if($_POST["save"]=="do"){
	if($_POST["case_p"]=="change"){	
		$sql="UPDATE ".$prefix."_video SET id_theloai=".$_POST["id_theloai"]." WHERE id=".$_POST["id"]."";
	}
	if($_POST["case_p"]=="delete"){	
		$sql="DELETE from ".$prefix."_video  WHERE id=".$_POST["id"]."";		
	}	

		$db->sql_query($sql);	
		exit;
}

    include ("../header.php");

    GraphicAdmin();

	

   newstopbanner();

   Opentable();

   echo "<div align=\"center\"><b>Danh sách video</b></div>";
   
if(sizeof($_POST["box"])>0 && $_POST["id_theloai"]!=""){
	$txt_theloai=$_POST["txt_theloai"];
	for($i=0;$i<sizeof($_POST["box"]);$i++){
		$sql="insert into ".$prefix."_video(name,url,id_theloai,image,des,ihome,tid,leng_sec,viewer,user_id) values('".$a_you[1]."','".$a_you[0]."','".$txt_theloai."','$images','1','1',NULL,1,1,107)";	
		$sql="UPDATE ".$prefix."_video SET id_theloai=".$_POST["id_theloai"]." WHERE id=".$_POST["box"][$i]."";
		$db->sql_query($sql);
		echo "<div class='alert alert-success'>Saved - ".$a_you[1]." </div>";
	}
	
	
}   
echo "
<form method='get'>
<input type='hidden' name='op' value='videohome'>
<select name='id_theloai_view'>";
			$sql="select *from ".$prefix."_theloai order by theloai";
			$result=$db->sql_query($sql);
			while($row=$db->sql_fetchrow($result)){
				$theloai=splitcat($row["theloai"]);
				$xid=$row["id"];			
				echo "<option value=\"$xid\" >$theloai</option>";	
			}
    	echo "  
</select>
	<p><button class='btn btn-primary' type='submit'>View</button></p>
</form>	
<form method='post'>";
	echo "<table  width=\"100%\" class=\"table_video\">";
	if($_GET["id_theloai_view"]){
		$where_theloai="where id_theloai=".$_GET["id_theloai_view"]." order by id desc ";
	}else{
		$where_theloai=" order by id desc  limit 100 ";
	}	
	$sql="select * from ".$prefix."_video ".$where_theloai." ";

	$result=$db->sql_query($sql);

	$numrow=$db->sql_numrows($result);

	if($numrow!=0){

	while($row=$db->sql_fetchrow($result)){


			echo "<tr>";
			echo "<td >id: ".$row['id']."</td>";
			echo "<td >".$row['name']."</td>";
		   	echo "<td width=\"70\" ><img src=\"http://i1.ytimg.com/vi/".$row['url']."/default.jpg\"></td>";
			//echo "<td  >".splitcat($theloai)." </td>";
	
		  if($row["choice"]!=1){
			echo "<td><a href=\"admin.php?op=Video_Makechoice&id=".$row['id']."&case=1\">Edit</a></td>";
		   }else{
			echo "<td><a href=\"admin.php?op=Video_Makechoice&id=".$row['id']."&case=0\"><b style=\"color:red;font-weight:bold;\">Nên xem</b></a></td>";
		   }
			echo "<td><a href=\"admin.php?op=Video_Edit&amp;id=".$row['id']."\">Edit</a></td>";
	
			echo "<td><a href=\"admin.php?op=Video_Delete&amp;id=".$row['id']."\">Delete </a>  
			
			<input type='checkbox' name='box[]' value='".$row['id']."' class='box_giangsu'>
			
			</td>";
	
			echo "</tr>";
		}


	echo "</table>";
	
echo "
<p>

<select name='id_theloai'  style='position:fixed;top:0px;right:0px;'>";

			$sql="select *from ".$prefix."_theloai order by theloai";

			$result=$db->sql_query($sql);

			while($row=$db->sql_fetchrow($result))

			{

				$theloai=splitcat($row["theloai"]);

				$xid=$row["id"];

				if($idtheloai==$xid)

    				echo "<option value=\"$xid\" selected=\"selected\">$theloai</option>";

				else

					echo "<option value=\"$xid\" >$theloai</option>";	

			}

   			

    	echo "  </select>
<!--

<input style='position:fixed;top:0px;right:0px;' type='text' name='id_theloai'>

-->

</p>

<button class='btn btn-primary'  type='submit'>Save</button>

</form>";

	}else {

		echo "<center>No videos have been entered into the Database yet</center>";

	}

Closetable();

	

	 include ("../footer.php");

	

}



function read_dir($dir) {

   $array = array();

   $d = dir($dir);

   while (false !== ($entry = $d->read())) {

       if($entry!='.' && $entry!='..') {

           $entry = $entry;

           if(is_dir($entry)) {

               $array[] = $entry;

               $array = array_merge($array, read_dir($entry));

           } else {

               $array[] = $entry;

           }

       }

   }

   $d->close();

   return $array;

}
function check_video_trung(){
	global $db,$prefix;

    include ("../header.php");
    GraphicAdmin();
	newstopbanner();
	if(true){
		$data=gets_video(0,3000,"all");
		$array_trung=array();
		for($i=0;$i<sizeof($data);$i++){
			echo "<strong>Kiểm tra</strong>".$data[$i]["id"]." - ".$data[$i]["url"]." - ".$data[$i]["name"]."<br>";		
			$k=$i+1;
			for($j=$k;$j<sizeof($data);$j++){		
				if($data[$i]["url"]==$data[$j]["url"] || in_array($data[$i]["url"],$array_trung)){
					if(!in_array($data[$i]["url"],$array_trung)){
						$array_trung[]=$data[$i]["id"];
						echo "<strong>Trùng</strong>".$data[$i]["id"]." _ _ ".$data[$j]["id"]." - ".$data[$i]["url"]." - ".$data[$i]["name"]."<br>";
					}
					break;
				}
			}
			if($i==1000) break;
		}		

		$str_array=implode(",",$array_trung);
		$sql="DELETE FROM ".$prefix."_video WHERE id in (".$str_array.")";
		echo $sql."<br>";

		//$db->sql_query($sql);			
	}

    include ("../footer.php");			
}
function them_video()

{

	global $prefix, $db;

    include ("../header.php");

    GraphicAdmin();

	newstopbanner();

	$ra=read_dir(INCLUDE_PATH."uploads/video/media");

	OpenTable();
	echo "<!--<script>

		function check(form){

			if (form.name.value == \"\") {

					alert(\""._CHECKNAMEVIDEO." ?\");

					form.name.focus();

					return false;

		 		}

			if( form.file.value==\"\") {

				alert(\""._CHECKURLVIDEO."?\");

				form.name.focus();

				return false;

			}

		}

	</script>-->";

	echo "<center><font class=\"title\"><b>Add Video</b></font></center>";

	

	$sql="select *from ".$prefix."_theloai";

	$result=$db->sql_query($sql);

echo  "<div align=\"center\"><form onsubmit=\"return check(this)\" action=\"admin.php?op=Video_Add\" method=\"post\" enctype=\"multipart/form-data\" name=\"form1\" id=\"form1\">

  <table width=\"100%\" >

    <tr>

      <td width=\"30%\" align=\"right\">Tên</td>

      <td width=\"70%\">

        <input name=\"name\" type=\"text\" id=\"name\" size=\"100\" />

		

      </td>

    </tr>

	<tr>

		<td width=\"30%\" align=\"right\">Hình ảnh: </td>

		<td width=\"70%\"><input type=\"file\" name=\"userfile\" /></td>

	</tr>

	<tr>

		<td width=\"30%\" align=\"right\">Chủ đề: </td>

		<td width=\"70%\">

			<select name=\"select\" style=\"width: 143px;\">";

			$sql="select *from ".$prefix."_theloai order by theloai";

			$result=$db->sql_query($sql);

			while($row=$db->sql_fetchrow($result))

			{

				$theloai=splitcat($row["theloai"]);
				$check="";
				$id=$row["id"];
				if($id==15)$check=" selected=\"selected\" ";

    			echo "<option value=\"$id\" $check>$theloai</option>";

			}

    		echo "	

  			</select>

		</td>

	</tr>";

	

	

	

	echo "<tr>

		<td width=\"30%\" align=\"right\">Video home</td>

		<td width=\"70%\">

			 <label>

  <input name=\"ihome\" type=\"radio\" value=\"1\" />

  yes</label>

  <label>

  <input name=\"ihome\" type=\"radio\" value=\"0\"  checked=\"checked\"/>

  No

</label>

  			</select>

		</td>

	</tr>";

	

	echo"<tr>

		<td width=\"30%\" align=\"right\"> Kiểu: </td>

		<td width=\"70%\">

			<select name=\"vtype\" style=\"width: 143px;\">";

			$sql="select * from ".$prefix."_video_type";

			$result=$db->sql_query($sql);

			while($row=$db->sql_fetchrow($result))

			{

				$theloai=$row["name"];

				$id=$row["tid"];

    			echo "<option value=\"$id\">$theloai</option>";

			}

    		echo "	

  			</select>

		</td>

	</tr>";

	

echo"    <tr>

      <td width=\"30%\" align=\"right\">"._URL."</td>

      <td width=\"70%\">";

	  

	echo"<input name=\"filevideo\" type=\"text\" id=\"filevideo\" size=\"80\" />";

	

	  echo "

      </td>

    </tr>";

	echo"    <tr>

      <td width=\"30%\" align=\"right\">"._URL."</td>

      <td width=\"70%\">";

		

	$sql="select url from ".$prefix."_video";

	$result = $db->sql_query($sql);

	$data=array();

    while($row = $db->sql_fetchrow($result))

	{

		$data[]=$row["url"];

	}

	  

	echo " <select name=\"myfilevideo\" style=\"width: 143px;\">";

	

	

	 for($i=0;$i<count($ra);$i++)

	 {

	 	if (!in_array($ra[$i], $data))

	 		echo "<option value=\"".$ra[$i]."\">".$ra[$i]."</option>";

	 }

	 echo "</select>(My video)";

	 

	

	  echo "

      </td>

    </tr>";

	

	echo"<tr><td colspan=\"2\" align=\"center\">
	<!--
	<textarea name=\"des\"></textarea>--></td></tr>";

		

    echo"<tr>

      <td colspan=\"2\" align=\"center\">

        <input type=\"submit\" name=\"Submit\" value=\"UpLoad\" />

      </td>

    </tr>

  </table>
";
	echo'<div id="xToolbar"></div>';
draw_input("des","","100%","300");


	echo"
</form></div>";





CloseTable();

include ("../footer.php");

}

function Delete($id,$ok=0)

{

global $adminfile, $prefix, $db;

    include ("../header.php");

    GraphicAdmin();

	newstopbanner();

	if($ok)

	{

		$sql="DELETE FROM ".$prefix."_video WHERE id='".$id."'";

		$db->sql_query($sql);

		Header("Location: admin.php?op=Video");

	}else {

	OpenTable();

	echo "You are about to delete this video. Are you sure? [ <a href=\"admin.php?op=Video_Delete&amp;id=".$id."&amp;ok=1\">yes</a>|<a href=\"admin.php?op=Video\">no</a> ]";

	CloseTable();

	}

	include ("../footer.php");

	

}

function Edit($id)

{

	 global $prefix, $db;

    include("../header.php");

    GraphicAdmin();

	newstopbanner();

   $id=(int)$_GET['id'];

   $ra=read_dir(INCLUDE_PATH."uploads/video/media");

    echo "<br>";

	$sql="SELECT a.*, b.code as code FROM ".$prefix."_video a, ".$prefix."_video_type b where id=$id and b.tid = a.tid limit 1";

	$result = $db->sql_query($sql);

    $row = $db->sql_fetchrow($result);

	$name=$row["name"];

	$url=$row["url"];

	$des=$row["des"];

	$idtheloai=$row["id_theloai"];

	$x=$row["image"];

	$ihome=(int)$row["ihome"];

	$tid=(int)$row["tid"];	

	$c= $row['code'];

	         $row2=$row;

	

	echo "
	<script>
		function check(form){
			if (form.name.value == \"\") {
				alert(\""._CHECK." ?\");
				form.name.focus();
				return false;
		 	}			
		}
	</script>";

	

	OpenTable();

	echo "<center><font class=\"title\"><b>Edit Video</b></font></center>";

	

	

echo  "<div align=\"center\"><form onsubmit=\"return check(this)\" action=\"admin.php?op=EditSave\" method=\"post\" enctype=\"multipart/form-data\" name=\"form1\" id=\"form1\">

  <table width=\"321\" >

    <tr>

      <td width=\"50%\" align=\"right\">Tên</td>

      <td width=\"50%\" align=\"left\">

        <input name=\"name\" type=\"text\" id=\"name\" value=\"$name\"  size=\"100\" />

      </td>

    </tr>
    <tr>

      <td width=\"50%\" align=\"right\">"._CATEGORIES."</td>

      <td width=\"50%\" align=\"left\">          

		  <select name=\"theloai\">";

			$sql="select *from ".$prefix."_theloai order by theloai";

			$result=$db->sql_query($sql);

			while($row=$db->sql_fetchrow($result))

			{

				$theloai=splitcat($row["theloai"]);

				$xid=$row["id"];

				if($idtheloai==$xid)

    				echo "<option value=\"$xid\" selected=\"selected\">$theloai</option>";

				else

					echo "<option value=\"$xid\" >$theloai</option>";	

			}

   			

    	echo "  </select>

      </td>

    </tr>

	<tr>";

	echo"<tr>

		<td width=\"30%\" align=\"right\"> Kiểu: </td>

		<td width=\"70%\">

			<select name=\"vtype\" style=\"width: 143px;\">";

			$sql="select * from ".$prefix."_video_type";

			$result=$db->sql_query($sql);

			while($row=$db->sql_fetchrow($result))

			{

				$theloai=$row["name"];

				$cid=$row["tid"];

				if($cid==$tid)

				{

    				echo "<option value=\"$cid\" selected=\"selected\">$theloai</option>";

				}

				else

				{

					echo "<option value=\"$cid\" >$theloai</option>";	

				}

			}

    		echo "	

  			</select>

		</td>

	</tr>";

				

		echo "<td width=\"50%\" align=\"right\">Video home</td>

		<td width=\"50%\">

			 <label>";




			 if ($ihome)

			 {

			 echo " <input name=\"ihome\" type=\"radio\" value=\"1\" checked=\"checked\"  />

  yes</label><label>

  <input name=\"ihome\" type=\"radio\" value=\"0\"  /> 

  No

</label>";

  }

  	else

	{

	echo " <input name=\"ihome\" type=\"radio\" value=\"1\"   />

  yes</label><label>

  <input name=\"ihome\" type=\"radio\" value=\"0\"  checked=\"checked\" /> 

  No

</label>";

	}

 echo " 		</td>

	</tr>

	

	<tr><td>";
       if($row2["choice"]!=1){
	    	echo "<td><a href=\"admin.php?op=Video_Makechoice&id=".$_GET['id']."&case=1\">Set Nên xem</a></td>";
        }else{
    		echo "<td><a href=\"admin.php?op=Video_Makechoice&id=".$_GET['id']."&case=0\"><b style=\"color:red;font-weight:bold;\">Nên xem</b></a></td>";
        }
    echo"</td><td>";

   //	echo "<input type=\"checkbox\" name=\"delpic\" value=\"yes\"><a href=\"../uploads/video/images/".$x."\"><b>".$x."</b></a><br><br>";

	echo "<input type=\"hidden\" name=\"images\" value=\"$x\">";

	echo "<input type=\"hidden\" name=\"id\" value=\"$id\">	

	</td></tr>

	<tr><td width=\"50%\" align=\"right\">Hình ảnh</td>

		<td>

			<input type=\"file\" name=\"userfile\" />

	</td>

	</tr>

	";

	echo "<tr><td width=\"50%\" align=\"right\">File</td>

		<td>";

	if($c=="MYVIDEO")

	{

		echo"<input name=\"filevideo\" type=\"text\" id=\"filevideo\" size=\"80\" value=\"\" />";

		echo"    <tr>

      <td width=\"30%\" align=\"right\">"._URL."</td>

      <td width=\"70%\">";

		

	

	  

	echo " <select name=\"myfilevideo\" style=\"width: 143px;\">";

	

	

	 for($i=0;$i<count($ra);$i++)

	 {

	 	if ($ra[$i]== $url)

		{

	 		echo "<option value=\"".$ra[$i]."\" selected=\"selected\">".$ra[$i]."</option>";

		}

		else

		{

			echo "<option value=\"".$ra[$i]."\">".$ra[$i]."</option>";

		}

	 }

	 echo "</select>(My video)";



	

	  echo "

      </td>

    </tr>";

	}

	else

	{

	

		echo"<input name=\"filevideo\" type=\"text\" id=\"filevideo\" size=\"80\" value=\"$url\" />";

		echo"    <tr>

      <td width=\"30%\" align=\"right\">"._URL."</td>

      <td width=\"70%\">";

		echo " <select name=\"myfilevideo\" style=\"width: 143px;\">";

		for($i=0;$i<count($ra);$i++)

		{

			if ($ra[$i]== $url)

			{

				echo "<option value=\"".$ra[$i]."\" selected=\"selected\">".$ra[$i]."</option>";

			}

			else

			{

				echo "<option value=\"".$ra[$i]."\">".$ra[$i]."</option>";

			}

		 }

	 echo "</select>(My video)";

	 

	

	  echo "

      </td>

    </tr>";

	

	}

	

  echo "</td>

	</tr>";

	

	echo"<tr><td colspan=\"2\" align=\"center\"> <!--<textarea name=\"des\">$des</textarea>-->  ";
	


	 

	echo"</td></tr>";

	echo "<tr>

      <td colspan=\"2\" align=\"center\">

        <input type=\"submit\" name=\"Submit\" value=\"Edit\" />

      </td>

    </tr>

  </table>";
	echo'<div id="xToolbar"></div>';  
	draw_input("des",$des,"100%","300");
?>
<input id="son" />
<div id="but_kit">kit</div>
<?php	  	
  echo "

</form></div>";

CloseTable();

include ("../footer.php");

}
function Video_Makechoice(){
	global $prefix, $db,$pathvideo;
 	$id=cleanup($_GET["id"]);
    $case=cleanup($_GET["case"]);
	$sql="UPDATE ".$prefix."_video SET choice=$case WHERE id='$id' ";
	$db->sql_query($sql);
	Header("Location: admin.php?op=Video");
}
function EditSave()

{

	global $prefix, $db,$pathvideo;

	$name=cleanup($_POST["name"]);

	$theloai=cleanup($_POST["theloai"]);

	$id=cleanup($_POST["id"]);

	$$delpic=cleanup($_POST["delpic"]);

	$images=cleanup($_POST["images"]);

	$des=cleanup($_POST["des"]);

	$url=cleanup($_POST["filevideo"]);

	$ihome=cleanup($_POST["ihome"]);

	$vtype = (int)$_POST['vtype'];

	$myfilevideo = stripslashes(FixQuotes($_POST['myfilevideo']));

	if($vtype==3)

		$url=$myfilevideo;

			

	$images = uploadimg($images, $delpic, 1, 100, $pathvideo);

	

	$sql="UPDATE ".$prefix."_video SET name='$name',url='$url', id_theloai='$theloai', tid='$vtype', image='$images', des='$des', ihome= '$ihome' WHERE id='$id' ";



	$db->sql_query($sql);

	Header("Location: admin.php?op=Video");



}



function Video_Add()

{

	global $prefix, $db,$pathvideo;

	global $max_size, $width;

	    

  

	$name=stripslashes(FixQuotes($_POST["name"]));
$name="1";
	$id=stripslashes(FixQuotes($_POST["select"]));

	$url = stripslashes(FixQuotes($_POST['filevideo']));

	$des = stripslashes(FixQuotes($_POST['des']));

	$ihome = (int)$_POST['ihome'];

	$vtype = (int)$_POST['vtype'];

	$myfilevideo = stripslashes(FixQuotes($_POST['myfilevideo']));

	if($vtype==3)

		$url=$myfilevideo;

	

	

	$images = @uploadimg($images, "yes", 1, 100, $pathvideo);
$array_url=explode(",",$url);
for($i=0;$i<sizeof($array_url);$i++){
	$url=$array_url[$i];
	$content = file_get_contents("http://youtube.com/get_video_info?video_id=".$url."");
	parse_str($content, $ytarr);
	$name=$ytarr['title'];
	$length_seconds=$ytarr["length_seconds"];
	$view_count=$ytarr["view_count"];
	$sql="insert into ".$prefix."_video(name,url,id_theloai,image,des,ihome,tid,leng_sec,viewer) values('$name','$url','$id','$images','$des','$ihome','$vtype',$length_seconds,$view_count)";	
	$db->sql_query($sql);
}
	Header("Location: admin.php?op=them_video");

	

}
function Check_Video(){
	global $prefix, $db;
	if($_REQUEST["case"]=="ajax"){
		$db->sql_query("update ".$prefix."_job set value=concat(value,',".$_REQUEST["url"]."') where jid=1 ");		

		$sql="update ".$prefix."_video set datecheck=-1 where id=".$_REQUEST["id"]." ";		
		if($db->sql_query($sql))
			echo "<h1> delete ".$sql."</h1><br>";
		else
			echo "<h1> delete - error ".$sql."</h1><br>";
		die;
	}

 include("../header.php");	
    GraphicAdmin();
	newstopbanner();
	
	$sql="select * from ".$prefix."_video where datecheck<>-1  order by id desc limit 1500";	
	$result=$db->sql_query($sql);	
	$i=0;
	echo "tổng cộng có ".$db->sql_numrows($result)."<br>";
	while($row=$db->sql_fetchrow($result)){
		$id=$row["id"];
		$url=$row["url"];
		$leng_sec=$row["leng_sec"];
		echo "<div class='sondeptrai' data-id='".$id."'  data-url='".$url."' style='float:left;padding:15px;margin-top:10px; width:120px;'> <img src='http://img.youtube.com/vi/".$url."/1.jpg'> <br>".$id."</div>";
		// $sql="update ".$prefix."_video set datecheck=".time()." where id=".$id." ";
		// $db->sql_query($sql);
	}
			?>
			<script type="text/javascript">

			</script>
			<?php
			
 include("../footer.php");	
}
function Check_Video3(){
	global $prefix, $db;
 include("../header.php");	
    GraphicAdmin();

	newstopbanner();
	
	$sql="select * from ".$prefix."_video order by id desc";
	$result=$db->sql_query($sql);	
	$i=0;
	while($row=$db->sql_fetchrow($result)){
		$id=$row["id"];
		$url=$row["url"];
		$leng_sec=$row["leng_sec"];
		if($leng_sec==0){
			$content = file_get_contents("http://youtube.com/get_video_info?video_id=".$url."");
			parse_str($content, $ytarr);		
			$length_seconds=$ytarr["length_seconds"];
			$sql="UPDATE ".$prefix."_video SET leng_sec=".$length_seconds." WHERE id='$id' ";						
	//		echo $sql"";
	//		break;
			$db->sql_query($sql);
			$i++;		
		}
	}	
	echo "Tổng số rec:".$i;
 include("../footer.php");	
}
function Check_Video2(){
	global $prefix, $db;
 include("../header.php");	
    GraphicAdmin();

	newstopbanner();
	
	$sql="select * from ".$prefix."_video order by id desc";
	$result=$db->sql_query($sql);	
	$i=0;
	while($row=$db->sql_fetchrow($result)){
		$id=$row["id"];
		$url=$row["url"];
		$viewer=$row["viewer"];
		if($viewer==0){
			$content = file_get_contents("http://youtube.com/get_video_info?video_id=".$url."");
			parse_str($content, $ytarr);		
			$view_count=$ytarr["view_count"];
			$sql="UPDATE ".$prefix."_video SET viewer=".$view_count." WHERE id='$id' ;";
			if($i>100)return;
			$db->sql_query($sql);
			$i++;
		}
	}	
	echo "Tổng số rec:".$i;
 include("../footer.php");	
}
function View($id)

{

	 global $prefix, $db;

	

    include("../header.php");

    GraphicAdmin();

	newstopbanner();

	$sql="select * from ".$prefix."_video where id=$id";

	$result=$db->sql_query($sql);

	$row=$db->sql_fetchrow($result);

	$name=$row["name"];

	$url=$row["url"];

	$id_theloai=$row["id_theloai"];

	$sql="select *from ".$prefix."_theloai where id=$id_theloai";

	$result=$db->sql_query($sql);

	$row=$db->sql_fetchrow($result);

	$theloai=$row["theloai"];

	echo "<table>

			<tr>

			<td>"._NAMEVIDEO.":  </td><td>$name</td></tr><tr>

			<td>"._CATEGORIES.":  </td><td>$theloai</td>

			</tr>

		</table>";

    OpenTable();

	

	$dir=INCLUDE_PATH."uploads/video/";

	$url=$dir.$url;

	echo "<div id=\"player\"><a href=\"http://www.macromedia.com/go/getflashplayer\">Get the Flash Player</a> to see this player.</div>";

	echo "<script type=\"text/javascript\" src=\"".INCLUDE_PATH."jscript/swfobject.js\"> </script>

<script type=\"text/javascript\">

  var s2 = new SWFObject('".INCLUDE_PATH."jscript/mediaplayer.swf','ply', '200','200','5');

    s2.addParam(\"allowfullscreen\",\"true\");

	s2.addVariable(\"file\",\"$url\");

	s2.addVariable(\"displayheight\",\"170\");

	s2.addVariable(\"backcolor\",\"0x000000\");

	s2.addVariable(\"frontcolor\",\"0xffffff\");

	s2.addVariable(\"lightcolor\",\"0xffffff\");

	s2.addVariable(\"autostart\",\"false\");

	s2.addVariable(\"repeat\",\"true\");

	s2.addVariable(\"wmode\",\"transparent\");

      s2.write('player');

</script>";

	CloseTable();

	OpenTable();

	echo "<div align=\"center\">Danh sách</div>";

	echo "<table border=\"1\" width=\"100%\">";

	

	echo "<br>";

	$sql="select * from ".$prefix."_video";

	$result=$db->sql_query($sql);

	$numrow=$db->sql_numrows($result);

	if($numrow!=0){

	while($row=$db->sql_fetchrow($result))

	{

		$idtheloai=$row["id_theloai"];

		$sql="select * from ".$prefix."_theloai where id=$idtheloai";

		$r=$db->sql_query($sql);

		$t=$db->sql_fetchrow($r);

		$theloai=$t["theloai"];

		echo "<tr>";

		echo "<td width=\"550\">".$row['name']."</td>";

		echo "<td width=\"70\" >".$theloai."</td>";

		echo "<td><a href=\"admin.php?op=Video_View&id=".$row['id']."\">View</a></td>";

		echo "<td><a href=\"admin.php?op=Video_Edit&amp;id=".$row['id']."\">Edit</a></td>";

		echo "<td><a href=\"admin.php?op=Video_Delete&amp;id=".$row['id']."\">Delete</a></td>";

		echo "</tr>";

	}

	echo "</table>";

	}else {

		echo "<center>No videos have been entered into the Database yet</center>";

	}

	CloseTable();

	include("../footer.php");



}
function son_upimages1($imginfo,$path,$newname){
	echo "son";
if ((($imginfo["type"] == "image/gif")
|| ($imginfo["type"] == "image/jpeg")
|| ($imginfo["type"] == "image/pjpeg"))
&& ($imginfo["size"] < 2000000))
  {
  if ($imginfo["error"] > 0)
    {
    echo "Return Code: " . $imginfo["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $imginfo["name"] . "<br />";
    echo "Type: " . $imginfo["type"] . "<br />";
    echo "Size: " . ($imginfo["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $imginfo["tmp_name"] . "<br />";

    if (file_exists("upload/" . $imginfo["name"]))
      {
      echo $imginfo["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($imginfo["tmp_name"],
       $path . $newname);
      echo "Stored in: " . $path . $newname;
      }
    }
  }
else
  {
  echo "Invalid file";
  }	
			
}
function add_theloai()

{

	global $prefix, $db,$shoppath;

    include("../header.php");

    GraphicAdmin();

	newstopbanner();

	$name=$_POST["name"];
	$images= time().".jpg";
	$gioithieu=$_POST["gioithieu"];
	
	$path = "../uploads/video/media/";
	if($_FILES["userfile_slite1"]){
		son_upimages1($_FILES["userfile_slite1"],$path,$images);
	}	
	$sql="select * from ".$prefix."_theloai where theloai='".$name."'";
	$result=$db->sql_query($sql);
	$n=$db->sql_numrows($result);
	if($n!=0){
		echo _THONGBAO;
	}
	else{

	$sql="insert into ".$prefix."_theloai(theloai,images,gioithieu) values('$name','$images','$gioithieu')";

	$db->sql_query($sql);

	Header("Location: admin.php?op=theloai");

	}

	include("../footer.php");

}

function theloai()

{

	global $prefix, $db,$site_live;

    include("../header.php");

    GraphicAdmin();

	newstopbanner();

	echo "<script>

			function checkname(form){

				if (form.name.value == \"\") {

					alert(\""._CHECK." ?\");

					form.name.focus();

					return false;

		 		}

			}

			</script>";

Opentable();
	echo "<form onsubmit=\"return checkname(this)\" action=\"admin.php?op=Add_theloai\" method=\"post\" enctype='multipart/form-data'>
<div class='row-fluid'><div class='span5 text-right'>"._NAME.": </div>  <div class='span5 text-left'><input type=\"text\" name=\"name\" /></div></div>

<div class='row-fluid'><div class='span5 text-right'>Hình ảnh: </div> <div class='span5 text-left'><input type='file' name='userfile_slite1' /></div></div>

<div class='row-fluid'>

	<div class='span5 text-right'>
		Giới thiệu: 
	</div> 
	<div class='span5 text-left'>
		<buton class='btn btn-info btn_gioithieu'>Mở giới thiệu</button>
	</div> 	

</div>


<div class='row-fluid'>  
	<div class='' style='margin:0 auto; width:800px;'>

	<div class='gioithieu_txt' style='display:none;'>
	";
		echo'<div id="xToolbar"></div>';
		draw_input("gioithieu","","100%",300);
	echo "
	</div>
	</div>
</div>

<div class='row-fluid show-grid text-center' style='margin:10px 0;'><button type='submit' class='btn-primary btn-small'>Save nhóm Video</button></div>  
	</form>";

Closetable();
	$sql="select * from ".$prefix."_theloai order by theloai";
	$result=$db->sql_query($sql);
	while($row=$db->sql_fetchrow($result)){
		$theloai=$row["theloai"];
		$images=$row["images"];
		$id=$row["id"];
		if($images==0){
			$images="".$site_live."images/no_image.jpg";
		}else{
			$images="../uploads/video/media/".$images."";			
		}
		echo "
		<div class='row'>
			<div class='span6'>".$theloai."</div>
			<div class='span2' style='padding:10px;'><img src='".$images."' class='img-polaroid'></div>
			<div class='span1'><a href=\"admin.php?op=Edittheloai&id=".$id."\">Edit</a></div>
			<div class='span1'><a href=\"admin.php?op=Deletetheloai&id=".$id."\">Delete</a></div>
		</div>
		";
	}


	 include ("../footer.php");

	

}

function Edit_the_loai($id)

{

	global $prefix, $db;

    include("../header.php");

    GraphicAdmin();

	newstopbanner();

	echo "<script>

			function checkname(form){

				if (form.name.value == \"\") {

					alert(\""._CHECK." ?\");

					form.name.focus();

					return false;

		 		}

			}

			</script>";

	$sql="select * from ".$prefix."_theloai where id=$id";

	$result=$db->sql_query($sql);

	$row=$db->sql_fetchrow($result);

	$theloai=$row["theloai"];
	$images=$row["images"];
	$gioithieu=$row["gioithieu"];
	
	Opentable();
	
	
echo "<form action=\"admin.php?op=Editsave_theloai\" method=\"post\" enctype='multipart/form-data'>
<div class='row'>
	<div class='span5'>
		<span><img src='../uploads/video/media/".$images."' class='img-rounded'></span>
	</div>
	<div class='span7'>
		<div class='row-fluid'><div class='span3 text-right'>"._NAME.": </div>  <div class='span5 text-left'><input type=\"text\" name=\"name\" value='".$theloai."' /></div></div>
		<div class='row-fluid'><div class='span3 text-right'>Hình ảnh: </div> <div class='span5 text-left'><input type='file' name='userfile_slite1' /></div></div>


<div class='row-fluid'><div class='span5 text-right'>Giới thiệu: </div>
<buton class='btn btn-info btn_gioithieu'>Mở giới thiệu</button>

 </div><div class='row-fluid'>  
 
 <div class='gioithieu_txt' style='display:none;'>
";

	echo'<div id="xToolbar"></div>';
	draw_input("gioithieu","$gioithieu","100%",300);
	
echo "		
	</div>
		</div>
		<input type=\"hidden\" name=\"id\" value=\"$id\">
	</div>
</div>
<div class='row-fluid show-grid text-center' style='margin:10px 0;'><button type='submit' class='btn-primary btn-small'>Save nhóm Video</button></div>  
	</form>";



 Closetable();	

	 include ("../footer.php");

}

function Editsave_theloai()

{

	global $prefix, $db;

	$name=$_POST["name"];
	$gioithieu=$_POST["gioithieu"];

	$sql="select * from ".$prefix."_theloai where id='".$_POST["id"]."'";
	$result=$db->sql_query($sql);
	$row=$db->sql_fetchrow($result);
	
	$images= time().".jpg";
	$path = "../uploads/video/media/";
	$info_images=array();
	if($_FILES["userfile_slite1"]["name"]!=""){
		@unlink($path.$row["images"]);
		son_upimages1($_FILES["userfile_slite1"],$path,$images);
		$info_images=array(", images='".$images."'");
	}	

	$id=$_POST["id"];
	$sql="UPDATE ".$prefix."_theloai SET theloai='$name', gioithieu='$gioithieu' ".$info_images[0]." WHERE id='$id' ";

	echo "   ".$sql;

	$db->sql_query($sql);

	Header("Location: admin.php?op=theloai");



}

function Delete_theloai($id,$ok=0)

{

	global $adminfile, $prefix, $db;

    include ("../header.php");

    GraphicAdmin();

	

	if($ok)

	{

		$sql="DELETE FROM ".$prefix."_theloai WHERE id='".$id."'";

		$db->sql_query($sql);

		Header("Location: admin.php?op=theloai");

	}else {

	OpenTable();

	echo "You are about to delete this video. Are you sure? [ <a href=\"admin.php?op=Deletetheloai&amp;id=".$id."&amp;ok=1\">yes</a>|<a href=\"admin.php?op=theloai\">no</a> ]";

	CloseTable();

	}

	include("../footer.php");

}



function them_code()

{

	global $adminfile, $prefix, $db;

    include ("../header.php");

    GraphicAdmin();

	newstopbanner();

	OpenTable();

	echo "<form id=\"xx\" name=\"xx\" method=\"post\" action=\"admin.php?op=saveaddcode\">

	

  <label>Tên: 

  <input type=\"text\" name=\"txttitle\"  size=\"30\"/>

  <br />

  </label>

  <label>

  Code

   <input type=\"text\" name=\"txtcode\"  size=\"30\"/>

  </label>

  <p>

    <label>

    <input type=\"submit\" name=\"Submit\" value=\"Submit\" />

    </label>

  </p>

</form>";





	CloseTable();

	

	include("../footer.php");

}



function save_add_code()

{

	global $adminfile, $prefix, $db;

	$txttitle=stripslashes(FixQuotes($_POST["txttitle"]));

	$txtcode=stripslashes(FixQuotes($_POST["txtcode"]));	

	

	$sql="insert into ".$prefix."_video_type(name,code) values('$txttitle','$txtcode')";

	$db->sql_query($sql);

	Header("Location: admin.php?op=Video");

}



switch($op) {
	case "import_youtube":
		import_youtube();
	break;
	case "check_video_trung":
		check_video_trung();
	break;
	
	case "Video_Makechoice":
		Video_Makechoice();
	break;

	case "Check_Video":
		Check_Video();
	break;
	case "videotags":
		videotags();
	break;
	case "videohome":

	Videohome();

	break;

	

	case "Video":

	Videohome();

	break;

	

	case "Video_Delete":	

	Delete($id,$ok);

	break;

	

	case "Video_Edit":

	Edit($id);

	break;

	

	case "Video_Add":

	Video_Add();

	break;

	

	case "EditSave":

	EditSave();

	break;

	

	case "Video_View":

	View($id);

	break;

	

	case "them_video":

	them_video();

	break;

	

	case "Add_theloai":

	add_theloai();

	break;

		

   	case "theloai":

	theloai();

	break;

	

	case "Edittheloai":

	Edit_the_loai($id);

	break;

	

	case "Editsave_theloai":

	Editsave_theloai();

	break;

	

	case "Deletetheloai":

	Delete_theloai($id,$ok);

	break;

	

	case "them_code":

	them_code();

	break;

	

	case "saveaddcode":

	save_add_code();

	break;

	

	

	

}

} else {

    echo "Access Denied";

}

?>