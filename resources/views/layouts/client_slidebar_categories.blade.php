         @php
            function data_tree($data,$parent_id = 0)
            {
                echo "<ul class='sub-menu'>";
                foreach ($data as $item) {
                    if($item['productcatStatus']=="Công khai")
                    {
                        if($item['parent_id']==$parent_id)
                        {
                            echo "<li>"."<a href=".route("client.product.product_cat",$item['id']).">".$item['productcatName']."</a>";
                            $id=$item['id'];
                            data_tree($data,$id);
                        }
                    }
                }
                echo "</li>";
                echo "</ul>";
            // echo "<i class='fa fa-angle-right arrow' aria-hidden='true'></i>";
            }
          @endphp