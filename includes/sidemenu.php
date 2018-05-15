 
<div class="sidebar collapse">
        	<ul class="navigation">
            	<li class="active"><a href="home.php"><i class="fa fa-laptop"></i> Dashboard</a></li> 
                
                <!-- NORMAL USERS -->
                <?php
                if($arraylogUser['account_type']==7 || $arraylogUser['account_type']==1)
                {
                ?>
                 <li>
                    <a href="#" class="expand"><i class="fa fa-align-justify"></i>My Imprest</a>
                    <ul>
                        <li><a href="imprest_view.php">Register Imprest</a></li>
                        <li><a href="imprest_retirement_view.php" >Imprest Retirement</a></li>
                    </ul>
                </li>
                  <li>
                    <a href="#" class="expand"><i class="fa fa-book"></i> Reports Management</a>
                    <ul>
                        <li><a href="unretired_user_report.php">Un-retired Imprest</a></li>
                        <li><a href="retired_user_report.php">Retired Imprest</a></li>
                 </ul>
                </li>
                <?php
                }
                ?>
                <!-- END OF NORMAL USERS -->
                <!-- APPROVALS -->
                <?php
                if($arraylogUser['account_type']==2)
                {
                ?>
                <li>
                    <a href="#" class="expand"><i class="fa fa-align-justify"></i>My Imprest</a>
                    <ul>
                        <li><a href="imprest_view.php">Register Imprest</a></li>
                        <li><a href="imprest_retirement_view.php" >Imprest Retirement</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="expand"><i class="fa fa-align-justify"></i>Imprest Approvals</a>
                    <ul>
                        <li><a href="imprest_approval.php">View Imprest Requested </a></li>
                         <li><a href="imprest_retirement_approval.php">View Imprest Retirement</a></li>
                        
                    </ul>
                </li>
                  <li>
                    <a href="#" class="expand"><i class="fa fa-book"></i> Department Report</a>
                    <ul>
                        <li><a href="director_unretired_imprest_report.php">Un-retired Imprest</a></li>
                        <li><a href="director_approved_imprest_report.php">Approved Imprest</a></li>
                        <li><a href="director_graph_report.php">Graphical Statistics</a></li>
               
                 </ul>
                </li>
                <?php
                }
                ?>
                <!-- END OF APPROVALS -->
                <!-- FINANCE -->
                <?php
                if($arraylogUser['account_type']==3 || $arraylogUser['account_type']==4)
                {
                ?>
                  <li>
                    <a href="#" class="expand"><i class="fa fa-align-justify"></i>My Imprest</a>
                    <ul>
                        <li><a href="imprest_view.php">Register Imprest</a></li>
                        <li><a href="imprest_retirement_view.php" >Imprest Retirement</a></li>
                    </ul>
                </li>		
                  <li>
                    <a href="#" class="expand"><i class="fa fa-bar-chart-o"></i>Imprest Processing</a>
                    <ul>
                        <li><a href="imprest_accountant_approval.php">View New Imprest </a></li>
                         <li><a href="imprest_accountant_checked.php">Checked Imprest </a></li>    
                    </ul>
                </li>
                  <li>
                    <a href="#" class="expand"><i class="fa fa-book"></i> Reports Management</a>
                    <ul>
                        <li><a href="#">Manage reports</a></li>
                        <li><a href="#">Audit Trails</a></li>
               
                 </ul>
                </li>
                <?php
                }
                ?>
               <?php  if($arraylogUser['account_type']==4)
               {
                   ?>
                 <li>
                    <a href="#" class="expand"><i class="fa fa-align-justify"></i>Imprest Approvals</a>
                    <ul>
                        <li><a href="#">View Imprest </a></li>
                    </ul>
                </li>
                <?php
                }
                ?>
                <!-- END OF FINANCE -->
                 <?php
                if($arraylogUser['account_type']==7)
                {
                ?>
                   <li>
                    <a href="#" class="expand"><i class="fa fa-user"></i>Users Management</a>
                    <ul>
                        <li><a href="users_view.php">Register User</a></li>
                    </ul>
                </li>
                <?php
                }
                ?>
                <?php
                 if($arraylogUser['account_type']==8)
                {
                ?>
                  <li>
                    <a href="#" class="expand"><i class="fa fa-align-justify"></i>My Imprest</a>
                    <ul>
                        <li><a href="imprest_view.php">Register Imprest</a></li>
                        <li><a href="imprest_retirement_view.php" >Imprest Retirement</a></li>
                    </ul>
                </li>		
                  <li>
                    <a href="#" class="expand"><i class="fa fa-bar-chart-o"></i>Imprest Vouchers</a>
                    <ul>
                        <li><a href="imprest_voucher.php">View New Imprest </a></li>
                         <li><a href="imprest_voucher_checked.php">Checked Imprest </a></li>    
                    </ul>
                </li>
                  <li>
                    <a href="#" class="expand"><i class="fa fa-book"></i> Reports Management</a>
                    <ul>
                        <li><a href="#">Manage reports</a></li>
                        <li><a href="#">Audit Trails</a></li>
               
                 </ul>
                </li>
                <?php
                }
                ?>
                                <!-- DCS ACCESSING MENU-->
                <?php
                if($arraylogUser['account_type']==5)
                {
                ?>
                <li>
                    <a href="#" class="expand"><i class="fa fa-align-justify"></i>My Imprest</a>
                    <ul>
                        <li><a href="imprest_view.php">Register Imprest</a></li>
                        <li><a href="imprest_retirement_view.php" >Imprest Retirement</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="expand"><i class="fa fa-align-justify"></i>Imprest Approvals</a>
                    <ul>
                        <li><a href="imprest_approval.php">View Imprest Requested </a></li>
                         <li><a href="imprest_retirement_approval.php">View Imprest Retirement</a></li>
                        
                    </ul>
                </li>
                  <li>
                    <a href="#" class="expand"><i class="fa fa-book"></i> Authority Report</a>
                    <ul>
                        <li><a href="dcs_unretired_imprest_report.php">Un-retired Imprest</a></li>
                        <li><a href="director_approved_imprest_report.php">Approved Imprest</a></li>
                        <li><a href="director_graph_report.php">Graphical Statistics</a></li>
               
                 </ul>
                </li>
                <?php
                }
                ?>
              
				
            </ul>
        </div>