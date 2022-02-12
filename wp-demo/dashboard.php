<?php
    function mydemo_dashboard() {
    global $wpdb;
    $name = '{not found}';
    if(isset($_POST['click'])){
        $name = $_POST['username'];
    }

    if(isset($_POST['add_data'])){
        $data = array(
            "name"=>$_POST['username'],
            "email"=>$_POST['email'],
            "address"=>$_POST['address']
        );
        $wpdb->insert("wp_demo_users",$data);
        $wpdb->show_errors(true);
        $wpdb->print_error();
    }

    if(isset($_POST['update_data'])){
        $data = array(
            "name"=>$_POST['username']
        );
        $where =  array('id'=>$_POST['user_id']); // data format
        $wpdb->update("wp_demo_users",$data,$where);
        $wpdb->show_errors(true);
        $wpdb->print_error();
    }

    if(isset($_POST['delete_data'])){
        $where =  array('id'=>$_POST['user_id']); // data format
        $wpdb->delete("wp_demo_users",$where);
        $wpdb->show_errors(true);
        $wpdb->print_error();
    }
?>
    <h1>Dashboard</h1>
    <div class="card">
    <p>Hello, My name is : <?php echo $name;?></p>
    <form action="" method="post">
        <label>Enter Your Name</label>
        <input type="text" name="username"/>
        <button type="submit" name="click">Print My Name</button>
    </form>
    </div>
    <hr>
    <div class="card">
    <h1>Add New Data</h1>
    <form action="" method="post">
        <label>Enter Your Name</label>
        <input type="text" name="username"/><br><br>
        <label>Email</label>
        <input type="email" name="email"/><br><br>
        <label>Address</label>
        <input type="text" name="address"/><br><br>
        <button type="submit" name="add_data">Add Data</button>
    </form>
</div>
    <hr>
    <div class="card">
    <h1>Update</h1>
    <form action="" method="post">
        <label>Update Name</label>
        <input type="text" name="username"/><br><br>
        <label>Where Id = </label>
        <input type="number" name="user_id"/><br><br>
        <input type="submit" name="update_data" value="Update">
    </form>
    </div>
    <hr>
    <div class="card">
    <h1>Delete</h1>
    <form action="" method="post">
        <label>Delelte User Where Id = </label>
        <input type="number" name="user_id"/><br><br>
        <input type="submit" name="delete_data" value="Delete">
    </form>
</div>
    <hr>
    <div class="card">
    <h1>All Users</h1>
    <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "demo_users";
        $rows = $wpdb->get_results("SELECT * from $table_name");
        ?>
        
        <table border="1" id="example" class='table table-striped table-hover'>
            <thead>
            <tr>
                <th class="manage-column ss-list-width">ID</th>
                <th class="manage-column ss-list-width">Name</th>
                <th class="manage-column ss-list-width">Email</th>
                <th class="manage-column ss-list-width">Address</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->id; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->name; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->email; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->address; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php 
    }
?>