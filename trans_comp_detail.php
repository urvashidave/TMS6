<?php 
include("database_connection.php");
$transrefno = $_POST['transrefno'];
$prodNo = $_POST['prodNo'];
//$transrefno = "0010032044";
//$prodNo = "0";

                    $query1="SELECT prod_id, temperature, grav_density, gr_gals, net_gals, uom, sign FROM TransComponents where trans_ref_no = '".$transrefno."' and prod_rec_no = '0".$prodNo."'";
                    //echo $query1;
                               		$result=$mysqli->query($query1);
                                        //$value = mysqli_fetch_array($result);
                                            $count = 0;
                                            while($value = mysqli_fetch_array($result))
                                            {
                                                echo "<tr class='comp'>";
                                                echo "<td><b>Component: </b></td><td>".$value['prod_id']."&emsp;</td>";
                                                echo "<td><b>Temperature: </b></td><td>".$value['temperature']."&emsp;</td>";
                                                echo "<td><b>Gravity: </b></td><td>".$value['grav_density']."&emsp;</td>";
                                                echo "<td><b>Gross: </b></td><td>".$value['gr_gals']."&emsp;</td>";
                                                echo "<td><b>Net: </b></td><td>".$value['net_gals']."&emsp;</td>";
                                                echo "<td><b>UOM: </b></td><td>".$value['uom']."&emsp;</td>";
                                                echo "<td><b>Sign: </b></td><td>".$value['sign']."&emsp;</td>";
                                                /////////////////////////////////////////////
                                                echo "<td>----</td><td>----</td>";
                                                echo "<td>----</td><td>----</td>";
                                                echo "<td>----</td><td>----</td>";
                                                echo "<td>----</td><td>----</td>";
                                                echo "<td>----</td><td>----</td>";
                                                echo "<td>----</td><td>----</td>";
                                                echo "<td>----</td><td>----</td>";
                                                echo "</tr>";
                                                $count++;
                                            }
                                            echo ":::".$count;
                                            //echo "<td><b>Container: </b></td><td>".$value['ContainerID']."&emsp;</td>";
?>