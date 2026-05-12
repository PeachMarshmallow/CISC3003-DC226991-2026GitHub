const validation = new JustValidate("#signup");

validation
    .addField("#name", [
        { rule: "required" }
    ])
    .addField("#email", [
        { rule: "required" },
        { rule: "email" },
        {
            validator: (value) => {
                return fetch("php/validate-email.php?email=" + encodeURIComponent(value))
                       .then(response => response.json())
                       .then(json => json.available);
            },
            errorMessage: "Email already taken - CISC3003: TAN PAK LONG + DC226991 + 2026"
        }
    ])
    .addField("#password", [
        { rule: "required" },
        { rule: "minLength", value: 8 }
    ])
    .onSuccess((event) => {
        document.getElementById("signup").submit();
    });
