<?php
if (!function_exists('getMenu')) {

	function getMenu($parent = 0)
	{

        $menu = queryMenuAll($parent);
        $data = array();
        foreach ($menu as $row) {
            $data[] = array(
                    'id_menu'        =>$row['id_menu'],
                    'name_menu'        =>$row['name_menu'],
                    'url_menu'        =>$row['url_menu'],
                    // recursive
                    'child'            =>getMenu($row['id_menu'])
                );
        }
        return $data;
   	 }

	 function queryMenuAll($parent)
    {
        $query = "select * from menu_admin as ma
                    where ma.parent_menu  = '".$parent."'";
        $menu = DB::select($query);
        $data = collect($menu)->map(function ($x) {
            return (array) $x;
        })->toArray();
        return $data;
    }
	     function printRecursiveListMenu($data)
	    {
	        $str = "";
	        foreach ($data as $list) {
	            if (!empty($list['child'])) {
	                $str .= '<li>
	                            <a href="#" onclick="setMenu('.$list['id_menu'].', \''.$list['name_menu'].'\')" class="menu-toggle">
	                               <span>'.$list['name_menu'].'</span>
	                           </a>';
	            } else {
	                $str .= '<li>
	                            <a onclick="setMenu('.$list['id_menu'].', \''.$list['name_menu'].'\')"  >
	                               <span>'.$list['name_menu'].'</span>
	                           </a>';
	            }

	            $subchild =printRecursiveListMenu($list['child']);
	            if (!empty($subchild)) {
	                $str .= '<ul class="ml-menu" >
	                            '.$subchild.'
	                        </ul>';
	            }
	            $str .= '</li>';
	        }
	        return $str;
	    }

	function mergeMenu($parent =0)
	{

        $menu = listMenu($parent);
        $data = array();
        foreach ($menu as $row) {
            $data[] = array(
                    'id_menu'        =>$row['id_menu'],
                    'name_menu'        =>$row['name_menu'],
                    'url_menu'        =>$row['url_menu'],
                    'parent_menu'        =>$row['parent_menu'],
                    'icon_menu'        =>$row['icon_menu'],
                    // recursive
                    'child'            =>mergeMenu($row['id_menu'])
                );
        }

        return $data;
   	 }



	    function listMenu($parent){
	    	$id_jabatan = Session::get('auth');
	    	$query = "SELECT * from menu_admin
					  where id_menu IN (SELECT id_menu from menu_role where id_jabatan=".$id_jabatan['id_jabatan'].") AND parent_menu = ".$parent."
						";

        $menu = DB::select($query);
		// echo "<pre>";
		// print_r($query);die;
        $role = collect($menu)->map(function ($x) {
            return (array) $x;
        })->toArray();


        return $role;



	    }

	    function ViewLeft($allMenu){
	 	$str = "";
	        foreach ($allMenu as $list) {
	        	 if (!empty($list['child'])) {
	                $str .= '<li>
		                <a href="#" class ="dropdown-toggle">
		               	<i class="material-icons">'.$list['icon_menu'].'</i>
		                <b class="arrow fa fa-angle-down"></b>'.$list['name_menu'].'</a>';
	            }else{
	                $str .= '<li >
		                <a href="'.url('/'.$list['url_menu']).'" >
		               	<i class="material-icons">'.$list['icon_menu'].'</i>
		                '.$list['name_menu'].'</a>';

	            }
	            $subchild =ViewLeft($list['child']);
	            if (!empty($subchild)) {
	                $str .= '<ul class="submenu" >
	                            '.$subchild.'
	                        </ul>';
	            }
	            $str .= '</li>';
	        }

	          return $str;
	    }
	}
 ?>
