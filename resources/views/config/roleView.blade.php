<?php 
	
	function printRole($allMenu,$id_menu){
		
	 	$str = "<ul>";	
	  
	        foreach ($allMenu as $list) {
	        	  $checked ="";
	            	if (in_array($list['id_menu'],$id_menu))
					{
	        			$checked ="checked";
						
					}
	            if (!empty($list['child'])) {
	                $str .= '<li >
	                           		 <input type="checkbox" name="id_menu[]" value="'.$list['id_menu'].'"  '.$checked.'><span>'.$list['name_menu'].'</span><br>
	                           ';
	            } else {
	                $str .= '<li> 
	                               
	                           		 <input type="checkbox" name="id_menu[]" value="'.$list['id_menu'].'" '.$checked.'><span>'.$list['name_menu'].'</span><br>
	                           ';
	            }

	            $subchild =printRole($list['child'],$id_menu);
	            if (!empty($subchild)) {
	                $str .= '<ul class="ml-menu" >
	                            '.$subchild.'
	                        </ul>';
	            }
	            $str .= '</li>';
	        }
	           $str .= '</ul>';
	        return $str;
	    }
	    /*echo "<pre>";
	print_r($allMenu);die;*/
	print_r(printRole($allMenu,$id_menu));
 ?>