<?php

include_once( 'classes/MichaelsInterfaceButton.php' );
?>

    <!Doctype html>
    <html lang="en">

    <head>
        <title>Students</title>
        <script src="javascript/uncompressedJQUERY.js"></script>
        <script src="javascript/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style/bootstrap.css">
    </head>

    <header>
        <!-- Title -->
        <div class="container">
            <h1 class="display-2 text-center mt-5">Students</h1>

            <!-- Divider -->
            <p class="border-top border-dark mt-4 mb-4"></p>
        </div>
    </header>

    <body>
    <!-- Modal create student -->
    <div class="modal fade" id="createStudent" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalTitle">New student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="interface.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="type" value="create">
                        <label for="createFirstname">Firstname</label>
                        <input type="text" class="form-control" id="createFirstname" name="firstname" required>
                        <label for="createLastname">Lastname</label>
                        <input type="text" class="form-control" id="createLastname" name="lastname" required>
                        <label for="createWhatever">Whatever</label>
                        <input type="text" class="form-control" id="createWhatever" name="whatever" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal update student -->
    <div class="modal fade" id="updateStudent" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalTitle">Update student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="interface.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="type" value="update">
                        <input type="hidden" id="updateId" name="id">
                        <label for="updateFirstname">Firstname</label>
                        <input type="text" class="form-control" id="updateFirstname" name="firstname" required>
                        <label for="updateLastname">Lastname</label>
                        <input type="text" class="form-control" id="updateLastname" name="lastname" required>
                        <label for="updateWhatever">Whatever</label>
                        <input type="text" class="form-control" id="updateWhatever" name="whatever" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal delete student -->
    <div class="modal fade" id="deleteStudent" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalTitle">Do you really want to delete this student?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="interface.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="type" value="delete">
                        <input type="hidden" id="deleteId" name="id">
                        <input type="hidden" class="form-control" id="deleteFirstname" name="firstname" required>
                        <input type="hidden" class="form-control" id="deleteLastname" name="lastname" required>
                        <input type="hidden" class="form-control" id="deleteWhatever" name="whatever" required>
                        <p id="deleteTextarea"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php

    // POST-Workflow
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        switch ($_POST['type']) {
            case 'create':
                $success = createStudent();
                if ($success) {
                    $alertMessage = 'Student successfully created!';
                    $alertType = 'alert-success';
                }
                else {
                    $alertMessage = 'Create of student not possible!';
                    $alertType = 'alert-danger';
                }
                break;
            case 'delete':
                $success = deleteStudent();
                if ($success) {
                    $alertMessage = 'Student successfully deleted!';
                    $alertType = 'alert-success';
                }
                else {
                    $alertMessage = 'Delete of student not possible!';
                    $alertType = 'alert-danger';
                }
                break;
            case 'update':
                $success = updateStudent();
                if ($success) {
                    $alertMessage = 'Student successfully updated!';
                    $alertType = 'alert-success';
                }
                else {
                    $alertMessage = 'Update of student not possible!';
                    $alertType = 'alert-danger';
                }
                break;
            default:
                break;
        }
    }
    ?>

    <!-- Alert-Secion -->
    <?php

    if (isset($alertMessage)) {
        ?>
        <div class="container">
            <div class="alert <?php echo $alertType ?> alert-dismissible fade show" role="alert">
                <?php echo $alertMessage ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <?php

    }
    ?>

    <!-- Menubar -->
    <div class="container">
        <button type="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#createStudent">Create new student</button>
    </div>

    <!-- Table -->
    <div class="container">
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="col-md-3">Firstname</th>
                <th class="col-md-3">Lastname</th>
                <th class="col-md-3">Whatever</th>
                <th class="col-md-2"></th>
            </tr>
            </thead>
            <tbody>
            <?php

            readStudent();
            ?>
            </tbody>
        </table>
    </div>

    </body>

    <script>

        function updateModal(id, firstname, lastname, whatever) {
            $("#updateId").val = id;
            $("#updateFirstname").val = firstname;
            $("#updateLastname").val = lastname;
            $("#updateWhatever").val = whatever;
            $("#updateStudent").modal();
        }

        function deleteModal(id, firstname, lastname, whatever) {
            $("#deleteId").val = id;
            $("#deleteFirstname").val = firstname;
            $("#deleteLastname").val = lastname;
            $("#deleteWhatever").val = whatever;
            $("#deleteTextarea").html(firstname + '<br>' + lastname + '<br>' + whatever);
            $("#deleteStudent").modal();
        }

    </script>

    </html>

<?php

function readStudent() {

    /*
    $students = curl('bla');
    if ($students === false){
        echo '<div class="alert alert-danger" role="alert">Something went wrong!</div>';
    }
    */
    $students = array(array('id' => '2', 'firstname' => 'Michael', 'lastname' => 'Schori', 'whatever' => 'Wohoo'));

    foreach ($students as $student) {

        echo '<tr>';
        echo '<td class="align-middle">' . $student['firstname'] . '</td>';
        echo '<td class="align-middle">' . $student['lastname'] . '</td>';
        echo '<td class="align-middle">' . $student['whatever'] . '</td>';
        echo '<td class="align-middle">';
        $button = new MichaelsInterfaceButton();
        $button->setButtonTitle('Update');
        $button->setButtonType('button');
        $button->setOnClickEvent('updateModal');
        $button->setButtonClass('btn btn-dark mr-2');
        $button->setButtonAttributes(array($student['id'], $student['firstname'], $student['lastname'], $student['whatever']));
        $button->createHtmlWithOnClick();
        $button->echoButton();

        $button->setButtonTitle('Delete');
        $button->setButtonType('button');
        $button->setOnClickEvent('deleteModal');
        $button->setButtonClass('btn btn-danger mr-2');
        $button->setButtonAttributes(array($student['id'], $student['firstname'], $student['lastname'], $student['whatever']));
        $button->createHtmlWithOnClick();
        $button->echoButton();
        echo '</td>';
        echo '</tr>';
    }
}

function createStudent() {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $whatever = $_POST['whatever'];

    $url = '';

    $result = curl($url);
    if ($result === false) {
        return false;
    }
    else {
        return true;
    }
}

function deleteStudent() {

    $id = $_POST['id'];

    $url = '';

    $result = curl($url);
    if ($result === false) {
        return false;
    }
    else {
        return true;
    }
}

function updateStudent() {

    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $whatever = $_POST['whatever'];

    $url = '';

    $result = curl($url);
    if ($result === false) {
        return false;
    }
    else {
        return true;
    }
}

function curl($url) {

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    if (curl_getinfo($curl, CURLINFO_RESPONSE_CODE) == 200) {
        curl_close($curl);
        return json_decode($result);
    }
    else {
        return false;
    }
}