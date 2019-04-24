<?php
//CADENAS UTILIZADAS EN INGÉS
$strings = array(
     //MAIN 
    "Welcome"=> "Welcome",
    "Add"=> "Add",
    "Edit" => "Edit",
    "Show" => "Show",
    "Delete" => "Delete",
    "Search" => "Search",
    "Building" => "Building: ",
    "Buildings" => "Buildings",
    "Show Buildings" => "Show Buildings",
    "Admin" => "Administration",
    "My Profile" => "My Profile",
    "Logout" => "Logout",
    "Login" => "Login",
    "Functionalities" => "Functionalities",
    "Permissions" => "Roles",
    "Spanish" => "Spanish",
    "Galician" => "Galician",
    "English" => "English",
    "Users" => "Users",
    "Do you want to change something?" => "Do you want to change something?",
    "Save" => "  Save",
    "Back" => "Back",
    "Extend" => "Extend",
    "Adjust" => "Adjust",
    "Error in the query on the database" => "Error in the query on the database",

    //BUILDING
    "sm_idBuilding" => "Identifier",
    "sm_nameBuilding" => "Building ",
    "sm_addressBuilding" => "Address",
    "sm_phoneBuilding" => "Phone",
    "idBuilding" => "Building identifier",
    "nameBuilding" => "Building",
    "addressBuilding" => "Address",
    "phoneBuilding" => "Phone",
    "Floors" => "Floors",
    "Show Floor" => "Show Floor",
    "Edit Building" => "Edit Building",
    "Delete Building" => "Delete Building",
    "Add Building" => "Add Building",
    "Show Building" => "Show Building",
    "Attention" => "Attention",
    "Are you sure you want to delete the building \"%s\" ?" => "Are you sure you want to delete the building \"%s\" ?",
    "The information that this building has will be lost" => "The information that this building has will be lost",
    "Cancel" => "Cancel",
    "Ok" => "Ok",
    "Datas of the new building" => "Datas of the new building",
    "What is the identifier of this building?" => "What is the identifier of this building?",
    "What building is it?" => "What building is it?",
    "What is its postal address?" => "What is its postal address?",
    "What is its phone?" => "What is its phone?",
    "Not in session. Add buildings requires login." => "Not in session. Add buildings requires login",
    "Not in session. Edit buildings requires login." => "Not in session. Edit buildings requires login",
    "Not in session. Delete buildings requires login." => "Not in session. Delete buildings requires login",
    "You don't have the necessary permits" => "You don't have the necessary permits",
    "Building \"%s\" successfully added." => "Building \"%s\" successfully added",
    "Building \"%s\" successfully deleted." => "Building \"%s\" successfully deleted",
    "Building \"%s\" successfully updated." => "Building \"%s\" successfully updated",

    //FLOOR
    "Floor" => "Floor: ",
    "Information about the building's floors" =>"Information about the building's floors",
    "idBuildingidFloor" => "Identifier",
    "sm_idFloor" => "Identifier",
    "sm_nameFloor" => "Floor",
    "sm_planFloor" => "Plan",
    "idFloor" => "Floor identifier",
    "nameFloor" => "Floor",
    "surfaceBuildingFloor" => "Builded surface",
    "surfaceUsefulFloor" => "Useful surface",
    "Click to see the plan" => "Click to see the plan",
    "sm_surfaceBuildingFloor" => "Builded surface",
    "sm_surfaceUsefulFloor" => "Useful surface",
    "Show Spaces" => "Show Spaces",
    "Add Floor" => "Add Floor",
    "Edit Floor" => "Edit Floor",
    "Delete Floor"=>"Delete Floor",
    "Show Floors" => "Show Floors",
    "Are you sure you want to delete the floor \"%s\"?" => "Are you sure you want to delete the floor \"%s\"?",
    "The information that this floor has will be lost" => "The information that this floor has will be lost",
    "Data of the new building's floor" => "Data of the new building's floor",
    "What is the identifier of this floor?" => "What is the identifier of this floor?",
    "What floor is it?" => "What floor is it?",
    "Is there a plan for this floor?" => "Is there a plan for this floor?",
    "What is the constructed surface?" => "What is the constructed surface?",
    "What is the useful surface?" => "What is the useful surface?",
    "Not in session. Add floors requires login." => "Not in session. Add floors requires login",
    "Not in session. Edit floors requires login." => "Not in session. Edit floors requires login",
    "Not in session. Delete floors requires login." => "Not in session. Delete floors requires login",
    "Floor \"%s\" successfully updated." => "Floor \"%s\" successfully updated",
    "Floor \"%s\" successfully added." => "Floor \"%s\" successfully added",
    "Floor \"%s\" successfully deleted." => "Floor \"%s\" successfully deleted",
    "Show Plan" => "Show Plan",

    //SPACE
    "Information about the building's spaces" => "Information about the building's spaces",
    "Spaces" => "Spaces",
    "sm_idSpace" => "Identifier",
    "sm_nameSpace" => "Space",
    "sm_surfaceSpace" => "Space surface",
    "sm_numberInventorySpace" => "Num. Inventory",
    "Show Space" => "Show Space",
    "Add Space" => "Add Space",
    "Edit Space" => "Edit Space",
    "Delete Space" => "Delete Space",
    "Show Space" => "Show Space",
    "SelectSpacePlan" => "SelectSpacePlan",
    "ShowSpacePlan" => "ShowSpacePlan",
    "EditSpacePlan" => "EditSpacePlan",
    "Are you sure you want to delete the space \"%s\" ?" => "Are you sure you want to delete the space \"%s\" ?",
    "The information that this space has will be lost" => "The information that this space has will be lost",
    "Clear" => "Clear",
    "Space successfully updated in plan" => "Space successfully updated in plan",
    "Select the space in the plan" => "Identify the space in the plane by selecting its vertices",
    "ViewSpace" => "Show Space",
    "SelectSpace" => "Select Space",
    "EditSpace" => "Edit Space",
    "Data of the new space" => "Data of the new space",
    "What is the identifier of this space?" => "What is the identifier of this space?",
    "What space is it?" => "What space is it?",
    "What is the number inventory?" => "What is the number inventory?",
    "What is the surface of space?" => "What is the surface of space?",
    "Space \"%s\" successfully added." => "Space \"%s\" successfully added",
    "Space \"%s\" successfully updated." => "Space \"%s\" successfully updated",
    "Space \"%s\" successfully deleted." => "Space \"%s\" successfully deleted",
    "Building, floor and space id are mandatory" => "Building, floor and space identifier are mandatory",
    "Building and floor id are mandatory" => "Building and floor identifier are mandatory",
    "Not in session. Add space requires login." => "Not in session. Add space requires login",
    "Not in session. Edit space requires login." => "Not in session. Edit space requires login",
    "Not in session. Delete space requires login." => "Not in session. Delete space requires login",
    "Click to edit the space in the plan" => "Click to edit the space in the plan",
    "Click to see the space in the plan" => "Click to see the space in the plan",

    //USER
    "User" => "User",
    "photo" => "Photo",
    "passwd" => "Password",
    "name" => "Name",
    "surname"=> "Surnames",
    "dni" => "ID Card",
    "birthdate" => "Birth Date",
    "email" => "Email",
    "phone" => "Phone",
    "ProfilePhoto" => "Profile Photo",
    "Show Users" => "Show Users",
    "User \"%s\" successfully added." => "User \"%s\" successfully added",
    "User \"%s\" successfully updated." => "User \"%s\" successfully updated",
    "User \"%s\" successfully deleted." => "El usuario \"%s\" se ha eliminado con éxito",
    "Not in session. Add users requires login." => "Not in session. Add users requires login",
    "Not in session. Edit user requires login." => "Not in session. Edit user requires login",
    "Not in session. Add users requires login." => "Not in session. Add users requires login",
    "Are you sure you want to delete the user \"%s\" ?" => "Are you sure you want to delete the user \"%s\" ?",
    "The information that this user has will be lost" => "The information that this user has will be lost",
    "Add User" => "Add User",
    "Show User" => "Show User",
    "Edit User" => "Edit User",
    "Delete User" => "Delete User",
    "Search User" => "Search User",
    "New user" => "New user",
    "What is the email of this user?" => "What is the email of this user?",
    "What is the password of this user?" => "What is the password of this user?",
    "Repeat password" => "Write the password again",
    "Repeat new password" => "Write the new password again",
    "What is the name of the user?" => "What is the name of the user?",
    "What are the user's surnames?" => "What are the user's surnames?",
    'What is its ID?' => "What is the user's ID Card?",
    "What is his birthdate?" => "What is the user's birth date?",
    "What is his email?" => "What is the user's email?",
    "What is his phone?" => "What is the user's phone?",
    "What is his group?" => "What is the user's role?",
    "Do you want to change the password?" => "Do you want to change the password?",
    "PasswordCharacters"=> "Min 8 characters",
    "PasswordLowercase"=> "One lower case",
    "PasswordUppercase"=> "One capital letter",
    "PasswordNumber"=> "One number",
    "Choose" => "Choose one",

    //FUNCTIONALITIES
    "Function: " => "Function: ",
    "idFunction" => "Functionality identifier",
    "nameFunction" => "Functionality name",
    "descripFunction" => "Functionality description",
    "Functionalities" => "Functionalities",
    "sm_nameFunction" => "Function",
    "sm_descripFunction" => "Description",
    "Add Functionality" => "Add Functionality",
    "Show Functionality" => "Show Functionality",
    "Edit Functionality" => "Edit Functionality",
    "Delete Functionality" => "Delete Functionality",
    "Datas of the new functionality" => "Datas of the new functionality",
    "What functionality is it?" => "What functionality is it?",
    "What is the functionality about?" => "What is the functionality about?",
    "Check the actions:" => "Select the actions:",
    "Actions associated with functionality:" => "Actions associated with functionality:",
    "Are you sure you want to delete the functionality \"%s\" ?" => "Are you sure you want to delete the functionality \"%s\" ?",
    "The information that this functionality has will be lost" => "The information that this functionality has will be lost",
    "Function id is mandatory" => "Function identifier is mandatory",
    "Not in session. Add functionalities requires login." => "Not in session. Add functionalities requires login",
    "Not in session. Edit functionalities requires login." => "Not in session. Edit functionalities requires login",
    "Not in session. Delete functionalities requires login." => "Not in session. Delete functionalities requires login",
    "Not in session. Show function requires login." => "Not in session. Show functionality requires login",
    "Functionality \"%s\" successfully added." => "Functionality \"%s\" successfully added",
    "Function \"%s\" successfully updated." => "Function \"%s\" successfully updated",
    "Function \"%s\" successfully deleted." => "Function \"%s\" successfully deleted",

    //GROUP
    "Groups" => "Roles",
    "sm_nameGroup" => "Role",
    "sm_descripGroup" => "Description",
    "Group id is mandatory" => "Group identifier is mandatory",
    "Add Group" => "Add Role",
    "Delete Group" => "Delete Role",
    "Edit Group" => "Edit Role",
    "Show Group" => "Show Role",
    "ShowUsersForGroup" => "ShowUsersForGroup",
    "Are you sure you want to delete the group \"%s\" ?" => "Are you sure you want to delete the group \"%s\" ?",
    "The information that this group has will be lost" => "The information that this group has will be lost",
    "Not in session. Add group requires login." => "Not in session. Add role requires login",
    "Not in session. Delete groups requires login." => "Not in session. Delete roles requires login",
    "Not in session. Edit groups requires login." => "Not in session. Edit roles requires login",
    "Group \"%s\" successfully added." => "Role \"%s\" successfully added",
    "Group \"%s\" successfully updated." => "Role \"%s\" successfully updated",
    "Group \"%s\" successfully deleted." => "Role \"%s\" successfully deleted",
    "Datas of the new group" => "Datas of the new role",
    "What group is it?" => "What role is it?",
    "What is the group about?" => "What is the role about?",

    //ACTION
    "Action :" => "Action: ",
    "idAction" => "Action identifier",
    "nameAction" => "Action name",
    "descriptAction" => "Action description",
    "Not in session. Add actions requires login." => "Not in session. Add actions requires login",
    "Not in session. Delete actions requires login." => "Not in session. Delete actions requires login",
    "Not in session. Edit actions requires login." => "Not in session. Edit actions requires login",
    "Not in session. Show action requires login." => "Not in session. Show action requires login",
    "Actions" => "Actions",
    "sm_nameAction" => "Action",
    "sm_descripAction" => "Description",
    "Add Action" => "Add Action",
    "Delete Action" => "Delete Action",
    "Edit Action" => "Edit Action",
    "Show Action" => "Show Action",
    "Are you sure you want to delete the action \"%s\" ?" => "Are you sure you want to delete the action \"%s\" ?",
    "The information that this action has will be lost" => "The information that this action has will be lost",
    "Action id is mandatory" => "Action identifier is mandatory",
    "Action \"%s\" successfully added." => "Action \"%s\" successfully added",
    "Action \"%s\" successfully updated." => "Action \"%s\" successfully updated",
    "Action \"%s\" successfully deleted." => "Action \"%s\" successfully deleted",
    "Datas of the new action" => "Datas of the new action",
    "What action is it?" => "What action is it?",
    "What is the action about?" => "What is the action about?",
    
)
?>
