document.getElementById("requestForm").addEventListener("submit", function(event) {
    event.preventDefault();

    // Simulate request submission (replace with actual submission logic)
    setTimeout(function() {
        document.getElementById("requestForm").reset();
        document.getElementById("requestForm").style.display = "none";
        document.getElementById("confirmation").style.display = "block";
        document.getElementById("referenceNumber").innerText = generateReferenceNumber();
    }, 1000);
});

function generateReferenceNumber() {
    return Math.floor(1000 + Math.random() * 9000); // Generate a random 4-digit number
}



// **************Script for profile********

// Sample user data (replace with actual user data)
let user = {
    fullName: "John Doe",
    email: "john.doe@example.com",
    phone: "123-456-7890"
};

// Function to populate user profile form with data
function populateProfileForm() {
    document.getElementById("fullName").value = user.fullName;
    document.getElementById("email").value = user.email;
    document.getElementById("phone").value = user.phone;
}

// Function to enable form fields for editing
function enableEdit() {
    document.getElementById("fullName").disabled = false;
    document.getElementById("email").disabled = false;
    document.getElementById("phone").disabled = false;
    document.getElementById("editButton").style.display = "none";
    document.getElementById("saveButton").style.display = "inline-block";
}

// Function to save edited data
document.getElementById("profileForm").addEventListener("submit", function(event) {
    event.preventDefault();

    // Save edited data (replace with actual save logic)
    user.fullName = document.getElementById("fullName").value;
    user.email = document.getElementById("email").value;
    user.phone = document.getElementById("phone").value;

    // Disable form fields and show edit button
    document.getElementById("fullName").disabled = true;
    document.getElementById("email").disabled = true;
    document.getElementById("phone").disabled = true;
    document.getElementById("editButton").style.display = "inline-block";
    document.getElementById("saveButton").style.display = "none";
});

// Initial population of form
populateProfileForm();

