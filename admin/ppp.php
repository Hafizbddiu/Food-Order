<?php
                  
                    //excecute Query
                    $res=mysqli_query($conn,$sql);

                    //count rows 
                    $count=mysqli_num_rows($res);
                    //Count is greter than zero we will find data other wise not
                    if($count>0){
                        //we have value
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get details of id
                            $id=$row['id'];
                            $title=$row['title'];
                            ?>
                             <option value="1"><?php  echo $id; ?><?php  echo $title; ?></option>
                            <?php

                        }

                    }
                    else{
                        //we do not have value
                        ?>
                          <option value="0">No category found</option>
                        <?php
                    }
                    ?>