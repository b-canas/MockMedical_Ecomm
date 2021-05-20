
    var MenuItems = document.getElementById("MenuItems");

    MenuItems.style.maxHeight = "0px";



    function menutoggle(){
        if(MenuItems.style.maxHeight == "0px")
        {
            MenuItems.style.maxHeight = "200px";
        }
        else
        {
            MenuItems.style.maxHeight = "0px";
        }
    }

    /*
     * Form validation for admin's add new product form
     * Fields that need validation are:
     *  'id' => id cannot be equal to an existing product ID
     */
    function validateAddProductForm() {
         var table = document.getElementById("current_products_table");
         var totalRows = document.getElementById("current_products_table").rows.length;
         var columnIndexOfProductID = 0;

         var productIDs = [];   //this array will be populated with existing product ids
         var newProductID = document.forms["add_product_form"]["id"].value;   //the inputted value for the product ID

         for (var row = 1; row < totalRows; row++) {
            productIDs.push(table.rows[row].cells[columnIndexOfProductID].innerHTML);
         }

         if (productIDs.includes(newProductID)) {
            alert("Invalid submission. ID Exists. ID must be unique to this product.");
            return false;   //not a valid form submission
         }
         else {
            return true;    //valid for submission
         }
    }

    /*
     * Form validation for admin's update product form
     * Fields that need validation are:
     * any empty fields (at least one field needs to be filled in order to submit form)
     * 'id' => id cannot be equal to an existing product ID
     */
    function validateUpdateProduct() {

        /* Get form field values */
        var updatedCategory = document.forms["product_edit_form"]["new_category"].value;
        var updatedID = document.forms["product_edit_form"]["new_id"].value;
        var updatedName = document.forms["product_edit_form"]["new_name"].value;
        var updatedPrice = document.forms["product_edit_form"]["new_price"].value;
        var updatedStock = document.forms["product_edit_form"]["new_stock"].value;
        var updatedImage = document.forms["product_edit_form"]["new_image"].value;

        /* First check is an empty check. If all fields are empty, decline submission */
        if (updatedCategory == "" && updatedID == "" && updatedName == "" &&
            updatedPrice == "" && updatedStock == "" && updatedImage == "") {

            alert("At least one field must be filled to submit.");
            return false; //not a valid form submission
        }

        /* Second check is an ID check.
         * The new ID must be unique and not given to an existing product */
         var table = document.getElementById("existing_product_ids_table");
         var productIDs = [];   //this array will be populated with existing product ids

         /* existing_product_ids_table is expected to contain only 1 row with each table
          * cell having an existing product ID */
         var totalCols = table.rows[0].cells.length;

         for (var col = 0; col < totalCols; col++) {
            productIDs.push(table.rows[0].cells[col].innerHTML);
         }

         if (productIDs.includes(updatedID)) {
            alert("Invalid submission. ID is taken by an existing product. Refer to products page.");
            return false;   //not a valid form submission
         }
         else {
            return true;    //valid for submission
        }
    }

    /*
     * Form validation for admin's add new user form
     * Fields that need to be validated are:
     * 'password' && 'confirm_password' => must match
     * 'username' => must be unique for this new user
     * 'email' => must match the regex pattern of a typical email
     * 'phone_number' => must match the regex pattern of a typical phone number
     */
    function validateAddNewUser() {

        /* email regex verification taken from emailregex.com */
        const emailRegexPattern = new RegExp("(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&'*+/=?^_`"
                                            + "{|}~-]+)*|\"(?:[\\x01-\\x08\\x0b\\x0c\\x0e-\\x1f\\x21\\x23-\\"
                                            + "x5b\\x5d-\\x7f]|\\\\[\\x01-\\x09\\x0b\\x0c\\x0e-\\x7f])*\")"
                                            + "@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9]"
                                            + "(?:[a-z0-9-]*[a-z0-9])?|\\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?"
                                            + "[0-9][0-9]?)\\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?"
                                            + "|[a-z0-9-]*[a-z0-9]:(?:[\\x01-\\x08\\x0b\\x0c\\x0e-\\x1f\\x21"
                                            + "-\\x5a\\x53-\\x7f]|\\\\[\\x01-\\x09\\x0b\\x0c\\x0e-\\x7f])+"
                                            + ")\\])");

        /* phone number regex taken from https://www.baeldung.com/java-regex-validate-phone-numbers */
        const phoneNumRegexPattern = new RegExp("^((\\(\\d{3}\\))|\\d{3})[- .]?\\d{3}[- .]?\\d{4}$");

        /* First check if password and password confirm match */
        var password = document.forms["admin_add_user_form"]["password"].value;
        var confirmPassword = document.forms["admin_add_user_form"]["confirm_password"].value;

        if (password !== confirmPassword) {
            alert("Passwords do not match.");
            return false;   //not a valid form submission
        }

        /* Second check, username must be unique to this user */
        var username = document.forms["admin_add_user_form"]["username"].value;

        /* existing_usernames_table is expected to contain only 1 row with each table
         * cell having an existing user's username */
        var table = document.getElementById("existing_usernames_table");
        var totalCols = table.rows[0].cells.length;
        var currentUsernames = [];   //this array will be populated with existing product ids

        for (var col = 0; col < totalCols; col++) {
           currentUsernames.push(table.rows[0].cells[col].innerHTML);
        }

        if (currentUsernames.includes(username)) {
           alert("Invalid submission. Username is taken by an existing user. Refer to users page.");
           return false;   //not a valid form submission
        }

        /* Final checks are email and phone number. The inputs must match the regex requirements */
        var email = document.forms["admin_add_user_form"]["email"].value;
        var phoneNum = document.forms["admin_add_user_form"]["phone_number"].value;

        if (!emailRegexPattern.test(email)) { //"if pattern fails..."
            alert("Invalid Email Format.")
            return false;   //not a valid form submission
        }

        if (!phoneNumRegexPattern.test(phoneNum)) { //"if pattern fails..."
            alert("Invalid Phone Number format.")
            return false;   //not a valid form submission
        } else {
            return true;    //valid for submission
        }
    }

    /*
     * Form validation for admin's update user form
     * Fields that need to be validated are:
     * empty fields => at least one field must be filled in order to submit successfully
     * 'username' => must be unique for this new user
     * 'email' => must match the regex pattern of a typical email
     * 'phone_number' => must match the regex pattern of a typical phone number
     */
    function validateUserUpdate() {

        /* email regex verification taken from emailregex.com */
        const emailRegexPattern = new RegExp("(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&'*+/=?^_`"
                                            + "{|}~-]+)*|\"(?:[\\x01-\\x08\\x0b\\x0c\\x0e-\\x1f\\x21\\x23-\\"
                                            + "x5b\\x5d-\\x7f]|\\\\[\\x01-\\x09\\x0b\\x0c\\x0e-\\x7f])*\")"
                                            + "@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9]"
                                            + "(?:[a-z0-9-]*[a-z0-9])?|\\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?"
                                            + "[0-9][0-9]?)\\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?"
                                            + "|[a-z0-9-]*[a-z0-9]:(?:[\\x01-\\x08\\x0b\\x0c\\x0e-\\x1f\\x21"
                                            + "-\\x5a\\x53-\\x7f]|\\\\[\\x01-\\x09\\x0b\\x0c\\x0e-\\x7f])+"
                                            + ")\\])");

        /* phone number regex taken from https://www.baeldung.com/java-regex-validate-phone-numbers */
        const phoneNumRegexPattern = new RegExp("^((\\(\\d{3}\\))|\\d{3})[- .]?\\d{3}[- .]?\\d{4}$");

        /* First check if all fields are empty */
        var username = document.forms["admin_update_user_form"]["new_username"].value;
        var accessCode = document.forms["admin_update_user_form"]["access_code"].value;
        var firstName = document.forms["admin_update_user_form"]["first_name"].value;
        var lastName = document.forms["admin_update_user_form"]["last_name"].value;
        var address = document.forms["admin_update_user_form"]["address"].value;
        var phone = document.forms["admin_update_user_form"]["phone_number"].value;
        var email = document.forms["admin_update_user_form"]["email"].value;

        if (username == "" && accessCode == "" && firstName == "" && lastName == "" &&
            address == "" && phone == "" && email == "" ) {

            alert("At least one field must be filled to submit.");
            return false; //not a valid form submission
        }

        /* Second check, username must be unique to this user
         * existing_usernames_table is expected to contain only 1 row with each table
         * cell having an existing user's username */
        var table = document.getElementById("existing_usernames_table");
        var totalCols = table.rows[0].cells.length;
        var currentUsernames = [];   //this array will be populated with existing product ids

        for (var col = 0; col < totalCols; col++) {
           currentUsernames.push(table.rows[0].cells[col].innerHTML);
        }

        if (currentUsernames.includes(username)) {
           alert("Invalid submission. Username is taken by an existing user. Refer to users page.");
           return false;   //not a valid form submission
        }

        /* Third check, do email/phone_num match their regex patterns? */
        if (email != "" && !emailRegexPattern.test(email)) { //"if pattern fails..."
            alert("Invalid Email Format.")
            return false;   //not a valid form submission
        }

        if (phone != "" && !phoneNumRegexPattern.test(phone)) { //"if pattern fails..."
            alert("Invalid Phone Number format.")
            return false;   //not a valid form submission
        }

        return true;    //valid for submission
    }

    /*
     * Form validation for admin's update status form
     * Updates must follow this logic:
     * if (currentStatus == READY) => possibleStatusUpdates = {SHIPPED, CANCELLED}
     * if (currentStatus == SHIPPED) => possibleStatusUpdates = {DELIVERED}
     */
    function validateStatusUpdate(orderIndex) {
        //Create String for form name using orderIndex
        var formName = "status_update_form" + orderIndex;

        /* Get values for currentStatus and newStatus from the form */
        var currentStatus = document.forms[formName]["current_order_status"].value;
        var newStatus = document.forms[formName]["status_choices"].value;

        if (currentStatus == "READY" && (newStatus != "SHIPPED" || newStatus != "CANCELLED")) {
            alert("Invalid Update. An order with a READY status must move to either the SHIPPED or CANCELLED state.");
            return false;
        }

        if (currentStatus == "SHIPPED" && newStatus != "DELIVERED") {
            alert("Invalid Update. An order with a SHIPPED status must move to the DELIVERED state.")
            return false;
        }
    }

    /*
     * Form validation for a personal account update. This validation differs from validateUserUpdate because of a
     * password and confirm password field. Fields that need validation are:
     * empty fields => at least one field must be filled in order to submit successfully
     * 'username' => must be unique to this user
     * 'new_password' && 'confirm_password' => check if new password field matches confirm password
     * if password change request is made, old password field must be filled.
     * 'email' => must match the regex pattern of a typical email
     * 'phone_number' => must match the regex pattern of a typical phone number
     */
    function validateAccountUpdate() {

        /* email regex verification taken from emailregex.com */
        const emailRegexPattern = new RegExp("(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&'*+/=?^_`"
                                            + "{|}~-]+)*|\"(?:[\\x01-\\x08\\x0b\\x0c\\x0e-\\x1f\\x21\\x23-\\"
                                            + "x5b\\x5d-\\x7f]|\\\\[\\x01-\\x09\\x0b\\x0c\\x0e-\\x7f])*\")"
                                            + "@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9]"
                                            + "(?:[a-z0-9-]*[a-z0-9])?|\\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?"
                                            + "[0-9][0-9]?)\\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?"
                                            + "|[a-z0-9-]*[a-z0-9]:(?:[\\x01-\\x08\\x0b\\x0c\\x0e-\\x1f\\x21"
                                            + "-\\x5a\\x53-\\x7f]|\\\\[\\x01-\\x09\\x0b\\x0c\\x0e-\\x7f])+"
                                            + ")\\])");

        /* phone number regex taken from https://www.baeldung.com/java-regex-validate-phone-numbers */
        const phoneNumRegexPattern = new RegExp("^((\\(\\d{3}\\))|\\d{3})[- .]?\\d{3}[- .]?\\d{4}$");

        /* Get variables that need validation */
        var username = document.forms["admin_update_acc_form"]["new_username"].value;
        var oldPassword = document.forms["admin_update_acc_form"]["old_password"].value;
        var newPassword = document.forms["admin_update_acc_form"]["new_password"].value;
        var confirmPassword = document.forms["admin_update_acc_form"]["confirm_password"].value;
        var phone = document.forms["admin_update_acc_form"]["phone_number"].value;
        var email = document.forms["admin_update_acc_form"]["email"].value;

        if (username != "") {
            //get an array filled with existing usernames. Usernames must be unique to each account
            var currentUsernames = [];
            for (var col = 0; col < totalCols; col++) {
               currentUsernames.push(table.rows[0].cells[col].innerHTML);
            }

            if (currentUsernames.includes(username)) {
               alert("Invalid submission. Username is taken by an existing user. Refer to users page.");
               return false;   //not a valid form submission
            }
        }

        if (oldPassword != "" || newPassword != "" || confirmPassword != "") {
            //A password change request is being made, so all these fileds must be filled.
            if (oldPassword == "" || newPassword == "" || confirmPassword == "") {
                alert("If password change request is being changed please make sure all password fields are filled.");
                return false;
            }
            else if (newPassword != confirmPassword) {
                alert("New Password does not match Confirm Password.")
                return false;
            }
        }

        /* Third check, do email/phone_num match their regex patterns? */
        if (email != "" && !emailRegexPattern.test(email)) { //"if pattern fails..."
            alert("Invalid Email Format.")
            return false;   //not a valid form submission
        }

        if (phone != "" && !phoneNumRegexPattern.test(phone)) { //"if pattern fails..."
            alert("Invalid Phone Number format.")
            return false;   //not a valid form submission
        }

        return true;    //valid for submission
    }
