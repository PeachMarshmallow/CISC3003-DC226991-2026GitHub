
/* add code here  */
window.onload = function() {
    const form = document.getElementById("mainForm");
    const requiredFields = document.querySelectorAll(".required");
    const descriptionField = document.getElementById("description");

    descriptionField.addEventListener("focus", function() {
        descriptionField.classList.add("highlight");
    });

    descriptionField.addEventListener("blur", function() {
        descriptionField.classList.remove("highlight");
    });



    function validateForm(event) {
        let valid = true;
        requiredFields.forEach(field => {
            if (field.value.trim() === "") {
                field.classList.add("error");
                valid = false;
            } else {
                field.classList.remove("error");
            }
        });

        const yearField = document.getElementById("year");
        const yearValue = parseInt(yearField.value.trim(), 10);
        if (isNaN(yearValue) || yearValue < 1000 || yearValue > 2026) {
            yearField.classList.add("error");
            valid = false;
        }

        if (!valid) {
            alert("Please fill in all required fields and ensure the year is valid!");
            event.preventDefault();
        } else {

            const title = document.getElementById("title").value;
            const description = document.getElementById("description").value;
            const genre = document.getElementById("genre").value;
            const subject = document.getElementById("subject").value;
            const medium = document.getElementById("medium").value;
            const museum = document.getElementById("museum").value;
            const type = document.querySelector("input[name='type']:checked").value;
            const cc = Array.from(document.querySelectorAll("input[name='cc']:checked"))
                            .map(cb => cb.value).join(", ");

            alert(
                "Submission successful!\n\n" +
                "Title: " + title + "\n" +
                "Description: " + description + "\n" +
                "Genre: " + genre + "\n" +
                "Subject: " + subject + "\n" +
                "Medium: " + medium + "\n" +
                "Year: " + yearValue + "\n" +
                "Museum: " + museum + "\n" +
                "Type: " + type + "\n" +
                "CC: " + cc
            );
        }
    }

    form.addEventListener("reset", function() {
        requiredFields.forEach(field => field.classList.remove("error"));
    });

    form.addEventListener("submit", validateForm);

    requiredFields.forEach(field => {
        field.addEventListener("input", function() {
            if (field.value.trim() !== "") {
                field.classList.remove("error");
            }
        });
    });
};
