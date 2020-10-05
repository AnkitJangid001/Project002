<html>
	<head>
		<title>PHP File Handling</title>
		<style>
		body{
			margin-top: 0px;
			background-color: wheat;
		}
		form
		{
			padding-top:80px;

		}
		.FORM
		{
			background-color:#4CAF50 ;
			box-shadow: 20px 20px 20px;
			border-style:solid;
			border-width: 2px;
			width: 40%;
			height: 400px;
			float: left;
		}
		.selection
		{
			text-align: center;
			padding-top:20px;
			height:100px;
		}
		#upld
		{
		    height:10%;
		    font-size:24px;
		    width:60%;
		}
		#sub
		{
			background-color: wheat;
			padding: 20px 20px;
		}
		#res
		{
			background-color: wheat;
			padding: 20px 20px;
		}
		#leftframe
		{
			width:350px;
			height:400px;
			float: left;
			margin-left: 40px;
			margin-top: 80px;
			margin-right: 20px; 
		}
		#rightframe
		{
			width:400px;
			height:400px;
			float: left;
			margin-right: 10px;
			margin-left: 40px; 
		}
		</style>
	</head>

	<body>
		<marquee scrollamount="15"><h2 style="color: red">Here you can upload your files!!</h2></marquee>
		<iframe src="https://files.google.com/" id="leftframe"></iframe>
		<center>
			<form method="POST">
				<div class="FORM">
				<div class="selection"><h1>Select file to upload:</h1></div>
				<div><input type="file" name="upld" id="upld"></div>
				<br><br>
				<div><input type="submit" name="sub" id="sub" value="UPLOAD">
				<input type="reset" name="res" id="res"></div>	
				</div>
			</form>
		</center>
		<iframe src="https://en.wikipedia.org/wiki/Computer_file" id="rightframe"></iframe>
		<center>
			<?php
				if(isset($_POST['upld']))
				{
					ob_end_clean();               //clear page
					echo "<body style='background-color:lightblue'>";
					echo "<form action='djfile.php' method='POST'><center><br><br><br><br><br>";
					$file=$_POST["upld"];
					$opfile=fopen($file,"r") or die("Error while opening the file!");       //fopen stores file to the buffer
					echo filesize($file);					
					echo "<h1><b>File Content</b></h1><hr>";
					while(!feof($opfile)) {                            //feof to check the end of the file
 						 echo fgets($opfile)."<br>";         //fgets read the file line by line from the first line
					}                                    
					fclose($opfile);                                   //clear the buffer file
					echo "<input type='hidden' name='path' value='".$file."'><hr>";
					echo "<br><br><h2><i><label for='op'>Choose Operation</label></i></h2>";
				    echo "<select style='background-color:wheat' name='op' id='op'>";
				    echo"<option value='op1'>Delete File</option>";
				    echo"<option value='op2'>Append data</option>";
				    echo"<option value='op3'>Search data</option>";
					echo"<option value='op4'>Replace data</option>";
				    echo "</select>";

				    echo "<input type='submit' style='background-color:wheat' name='sub2'>";
				}
				echo "</center></form></body>";
			?>
			<?php
				if(isset($_POST['sub2'])){
					ob_end_clean();
					$file = $_POST['path'];
					if($_POST['op'] == 'op1'){

					echo "<body style='background-color:lightgreen'>";
					
					echo "<br><br><label for='delete'>Delete:</label>";
					echo "<input type='text' name='delete1' id='delete1' placeholder='delete data from the  table. ..'><br>";
			
					echo "<br><label for='pos'>Position:</label>";
				echo "<input type='text' name='pos' id='pos' placeholder='Append String at this position' title='character position'><br>";
					echo "<p><input type='hidden' name='path1' value='".$file."'></p>";
					echo "<input type='submit' style='background-color:wheat' name='sub7'>";
					echo "</form>";

						

						 echo "<body style='background-color:lightgreen'>";
						 echo "<h1>Say GoodBye to Your File... :(</h1><br>";
						 $var = unlink($file);
						 if($var == 1 )
							echo "<h1>Your file is deleted Successfully...</h1><br>";
						else
							echo "<h1>Error deleting your file!</h1><br>";
					}
					
					
					else if($_POST['op'] == 'op3'){
						echo "<body style='background-color:lightgreen'>";
						echo '<form action="djfile.php" method="POST"><h1>Search your data here....</h1> <br><br><label for="srch"><h3>Search String:</h3></label>
						<input type="text" style="background-color:#CCCCCC" name="srch" id="srch"><br><br><input type="hidden" name="path1" value="'.$file.'"><input type="submit" style="background-color:wheat" name="sub4"></form>';
					}
					
					else if($_POST['op'] == 'op4'){
						echo "<body style='background-color:lightgreen'>";
						echo '<form action="djfile.php" method="POST"><h1>Replace your data here....</h1><br><br><h3><label for="str1">Replace String:</label>
						<input type="text" name="str1" id="str1">
						<label for="str2">with the String:</label><input type="text" name="str2" id="str2"></h3><input type="hidden" name="path1" value="'.$file.'"><input type="submit" name="sub5" style="background-color:wheat" style="margin-left:5px;"></form>';
					}
					
					else
						echo "You should have selected something!!<br>";
				}
			?>
			<?php
			if(isset($_POST['sub7'])){

				$file = '';
				// The new person to add to the file
			
				$str="";
				$str .=$str1;
				$str.=" ";
				$str .=$str2;
				$str.=" ";
				$str .=$str3;
				$str .="\n";
				$contents = file_get_contents($file);
				$contents = str_replace($str, '', $contents);
				file_put_contents($file, $contents);
				
			}

			if(isset($_POST['sub3'])){

				$file = 'm.txt';
				// The new person to add to the file
				$str1=$_POST['appen1'];
				$str2=$_POST['appen2'];
				$str3=$_POST['appen3'];
				$str .=$str1;
				$str.=" ";
				$str .=$str2;
				$str.=" ";
				$str .=$str3;
				$str .="\n";
				 $len=strlen($str);
				 for($i=1 ; $i < $_POST['pos'] ; $i++ ){
				 	fwrite($opfile,$arr[$i]);
				 	}
				
			
				file_put_contents($file, $str, FILE_APPEND);
				 if(filesize($_POST['path1'])<$_POST['pos']){
				 	echo "Invalid Position for Insertion!<br>";
				 }
				 else{
				 $opfile = fopen($_POST['path1'],'r+');
				 $arr=new SplDoublyLinkedList();
				
				 while(!feof($opfile)){        //storing file char to the linked list
				 $arr->push(fgetc($opfile));
				 }
				 ob_end_clean();
				 fclose($opfile);
				 $opfile = fopen($_POST['path1'],'w');   //to clear text and start writing
				 	fwrite($opfile,$arr[0]);         
				 fclose($opfile);
				
				 $opfile = fopen($_POST['path1'],'a+');  //now to append
				 $str=$_POST['appen'];
				 $len=strlen($str);
				 for($i=1 ; $i < $_POST['pos'] ; $i++ ){
				 	fwrite($opfile,$arr[$i]);
				 }
				
				 $i=0;
				 while($i < $len )                      //appending insertion string
				 	fwrite($opfile,$str[$i++]);

				 $i=$_POST['pos'];
				 while($i<filesize($_POST['path1']))//rest of the text
				 	fwrite($opfile,$arr[$i++]);
					
				 fclose($opfile);
				 echo "<h1>String appended Successfully...</h1><br>";
				 }
			}
			
			if(isset($_POST['sub4'])){
			    ob_end_clean();
			    echo "<body style='background-color:#CCCCCC'>";
				$tmp=0;
				$se=$_POST['srch'];
				$count=0;    //number of occurences
				$ptr=0;      //position number
				$pos=array_fill(0,10,0);  //starting_index,array_length,value
				$len=strlen($_POST['srch']);
				$opfile=fopen($_POST['path1'],"c+");
				
				while(!feof($opfile)){
						$tmp=fgetc($opfile);
						if($tmp==$se[0]){
							$pos[$count]=$ptr;
							$tmp=1;
							while($tmp<=$len-1){
								$ptr++;
								if($se[$tmp]==fgetc($opfile)){
									$tmp++;
                                    continue;
								}
								else
									break;
							}
							if($tmp==$len)
								$count++;
						}
						$ptr++;
				}
                if($count>0){
			    echo "<h1>Your string was found in the file at this position(s): </h1><br>";
				for($tmp=0;$tmp<$count;$tmp++){
					echo "<h3>-->";
					echo $pos[$tmp]."</h3><br>";
				}
				}
				else
					echo "Your string was not found in the file!<br>";
			}
			
			if(isset($_POST['sub5'])){
				ob_end_clean();
				$opfile=fopen($_POST['path1'],'c+');
				$str1=$_POST['str1'];
				$l1=strlen($str1);
				$ptr=0;
				$loc=-1;
				while(!feof($opfile)){
						$tmp=fgetc($opfile);
						if($tmp==$str1[0]){
							$loc=$ptr;
							$tmp=1;
							while($tmp<=$l1-1){
								$ptr++;
								if($str1[$tmp]==fgetc($opfile)){
									$tmp++;
                                    continue;
								}
								else
									break;
							}
							if($tmp==$l1)
								break;
							else
								$loc=-1;
						}
						$ptr++;
				}
				if($loc==-1)
					echo "Your String was not found in the file!<br>";
					
				else{
					$str2=$_POST['str2'];
					$l2=strlen($str2);
					
					if($l1==$l2){
					fseek($opfile,$loc,SEEK_SET);
				    fwrite($opfile,$str2);
					}
					elseif($l1>$l2){
						fseek($opfile,$loc,SEEK_SET);
				        fwrite($opfile,$str2);
						$arr=array_fill(0,$l1-$l2,' ');
						$str=implode($arr);    //array to string conversion
						fwrite($opfile,$str);
					}
					else{
						$str3=array_fill(0,$l1,0);
						$i=0;
						while($i<$l1){
							$str3[$i]=$str2[$i];
							$i++;
						}
						$str3=implode($str3);
						fseek($opfile,$loc,SEEK_SET);
				        fwrite($opfile,$str3);
						
						$ofile = fopen($_POST['path1'],'r+');
						$arr=new SplDoublyLinkedList();
				
				        while(!feof($ofile))
				            $arr->push(fgetc($ofile));
				        fclose($ofile);
						//echo $arr->count();
				        $ofile = fopen($_POST['path1'],'w');   //to clear text and start writing
					    fwrite($ofile,$arr[0]);         
				        fclose($ofile);
				
				        $ofile = fopen($_POST['path1'],'a+');  //now to append
				        $str=array_fill(0,$l2-$l1,0);
						$i=0;
						while($i<$l2-$l1){
							$str[$i]=$str2[$l1+$i];
							++$i;
						}
	
				        for($i=1 ; $i < $loc+$l1 ; $i++ ){
					        fwrite($ofile,$arr[$i]);
				        }
				
				        $i=0;
				        while($i < $l2-$l1 )                      //appending insertion string
					        fwrite($ofile,$str[$i++]);

				        $i=$loc+$l1;
				            while($i<$arr->count())   //rest of the text
					            fwrite($ofile,$arr[$i++]);
					
				        fclose($ofile);
						
					}
					
					echo "<h1>Replaced Successfully...</h1><br>";
				
				fclose($opfile);
				}
			}
			?>
		</center>
		
	</body>
</html>