<?php
print_r($bai);
echo "<h2>Option</h2>"
. "<form action='".base_url()."option/save_option"."' method='post' >";
foreach ($array_option as $key => $value) {	
	$value_s=$this->db->where("option",$key)->get("option")->result();
	if($value["type"]=="boolean"){
		if(isset($value_s[0]->value))
			$value_m=(int)$value_s[0]->value;
		else
			$value_m=0;
		echo "<b>".$value["title"]." </b>";
		echo "<input type='radio' name='".$key."' value='1' ".($value_m==1?"checked":"")."> Có ";
		echo "<input type='radio' name='".$key."' value='0' ".($value_m==0?"checked":"")."> Không ";
	}	
	echo "<hr>";	
}
echo "<input type='submit' value='sub'></form>";

