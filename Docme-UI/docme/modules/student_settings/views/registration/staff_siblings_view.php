
        <?php
        
        
            if (isset($sibilings_data) && !empty($sibilings_data) && is_array($sibilings_data)) {
                $newsiblingArr = array();
    
                foreach($sibilings_data as $row){
                    
                    $newsiblingArr[] = array('Student_id' => $row['Student_id'],
                                                        'First_Name' => $row['First_Name'],
                                                        'Middle_Name' => $row['Middle_Name'],
                                                        'Last_Name' => $row['Last_Name'],
                                                        'profile_image' => $row['profile_image'],
                                                        'profile_image_alternate' => $row['profile_image_alternate'],
                                                        'Batch_Name' => $row['Batch_Name'],
                                                        'Description' => $row['Description'],
                                                        'Admn_No' => $row['Admn_No']
                                                        );
                $sibilings_data = array_map("unserialize", array_unique(array_map("serialize", $newsiblingArr)));
                }
                    $breaker = 0;?>
                    <span><h3>Siblings List</h3></span>
                    <?php foreach ($sibilings_data as $sibilings) {?>
                        <div class="col-lg-3">
                            <div class="contact-box center-version">
                                <a href="javascript:void(0);" style="padding-bottom:5px !important;">
                                    <?php
                                        $profile_image = "";
                                        if (!empty(get_student_image($sibilings['Student_id']))) {
                                            $profile_image = get_student_image($sibilings['Student_id']);
                                        } else if (isset($sibilings['profile_image']) && !empty($sibilings['profile_image'])) {
                                            $profile_image = "data:image/jpeg;base64," . $sibilings['profile_image'];
                                        } else {
                                            if (isset($sibilings['profile_image_alternate']) && !empty($sibilings['profile_image_alternate'])) {
                                                $profile_image = $sibilings['profile_image_alternate'];
                                            } else {
                                                $profile_image = base_url('assets/img/a0.jpg');
                                            }
                                        }
                                    ?>
                                    <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                                    <h3 class="m-b-xs pro-name" style="overflow:hidden;height: 48px;"><strong><?php echo strtoupper($sibilings['First_Name'] . ' ' . $sibilings['Middle_Name'] . ' ' . $sibilings['Last_Name']); ?></strong></h3>
                                    <div>
                                        <p><b>Class :</b>
                                            <?php echo isset($sibilings['Description']) && !empty($sibilings['Description']) ? $sibilings['Description'] : 'NIL'; ?>
                                        </p>
                                        <p style="height:36px;"><b>Batch :</b>
                                            <?php echo isset($sibilings['Batch_Name']) && !empty($sibilings['Batch_Name']) ? $sibilings['Batch_Name'] : 'Un Assigned'; ?>
                                        </p>
                                    </div>
                                </a>
                                <div class="font-bold" style="text-align: center;padding-bottom: 15px;">Admission No.: <?php echo $sibilings['Admn_No'] ?></div>
                            </div>
                        </div>
                        <?php
                                if ($breaker == 3) {
                                    echo '<div class="clearfix"></div>';
                                    $breaker = 0;
                                } else {
                                    $breaker++;
                                }
                    }
            }?>