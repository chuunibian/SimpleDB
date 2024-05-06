Austin Bian

$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "IP2";
$conn = new mysqli($servername, $username, $password, $dbname); <-- code used to access the mysql

This is read me for IP2 assignment. The goal of this read me is to outline the functionality of the project and explain the features and design choices. I am not good with css and I was the only one who made this program so I didnt have that much time to use css to make it look good.

a) This is add employee it allows the user to enter data into the respective fields. It gives guidelines on what is required and what is not required it also gives the form the data must be entered in as SALARY AND DATE are done by text or user input (I did not use html date selector because I find it to not work sometimes). This function does not check whether if anything is entered in the right format but it does check if ssn is empty or not and if SSN field is empty it will throw error.

Note: I did not make any drop downs for super_ssn because if there are two people of the same first and last name and SSN not shown due to privacy reasons then it will be ambiguous as such the user should enter ssns by own accord.

THIS FUNCTION ALSO CHECKS IF SSN IS DUPLICATE, IT CHECKS IF SUPER SSN IS AN EMPLOYEE, IT ALSO CHECKS IF DNO EXISTS BUT IS TRIVIAL, IT HAS ABILITY TO DETECT NULL VALUES FOR NON REQUIRED ITEMS.

b) This is add department and it allows user to enter data for the new department. It has ability to show current department names and numbers for user references. This funciton does not check if correct formatting is done for any field but it does have logical checks described below. The location entry for this new Dno is always set to columbus in dept locations.

THIS FUNCTION CHECKS IF MGR SSN EXISTS IN EMPLOYEES OR IF SSN PROVIDED IS EMPTY STRING BOTH THROW ERROR, CHECKS IF DNO ALREADY EXISTS OR IF DNO FIELD IS EMPTY BOTH THROW ERROR, FUNCTION CAN HAVE NULL VALUES FOR DATE

c) This is add works on it allows user to enter ssn then it will detect what department that employee works for and prompt for the respective projects under that department and number of hours. The format of the hours is not check but a guide is given to user.

THIS FUNCTION CHECKS IF SSN EXISTS IN EMPLOYEE AND IF SSN IS ENTERED AS EMPTY, THIS FUNCTION CHECKS IF COMBONATION OF SSN AND PNO ALREADY EXISTS IN WORKS_ON

d) This is remove employee, it allows user to enter employee ssn and it will delete or not depending on if it is manager without workers or manager with workers, for normal non-manager it will just delete them and all project records they have. 

THIS FUNCTION ALSO CHECKS IF SSN EXISTS, IF MANAGER IS DELETED THIS FUNCTION WILL ALSO DELETE DEPARTMENT MANAGED AND ANY PROJECT RECORDS AND DEPT_LOCATION ENTRIES WITH SAME DNO AND PROJECTS UNDER THAT DNO. THIS FUNCTION ALSO CHECKS IF THERE IS EMPLOYEE WORKING UNDER MGR AND WILL THROW MESSAGE AND NOT DELETE ANYTHING IN THAT CASE.