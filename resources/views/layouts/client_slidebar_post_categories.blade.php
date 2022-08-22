    @php
    function data_tree($data,$parent_id = 0)
    {
        echo "<ul class='sub-menu'>";
        foreach ($data as $item) {
           
                if($item['parent_id']==$parent_id)
                {
                    echo "<li>"."<a href=".route("client.blog.cat",$item['id']).">".$item['catName']."</a>";
                    $id=$item['id'];
                    data_tree($data,$id);
                }

        }
        echo "</li>";
        echo "</ul>";
    // echo "<i class='fa fa-angle-right arrow' aria-hidden='true'></i>";
    }
    @endphp