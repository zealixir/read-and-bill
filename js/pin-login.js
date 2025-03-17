const keysContainer = document.getElementById("keys-container");
const display = document.getElementById("display-input");
const container = document.getElementById("dots-container");

// Define the button values
const buttonValues = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "X", "0", ">"];

// Create 4 input fields dynamically
for (let i = 0; i < 4; i++) {
    const input = document.createElement("input");
    input.type = "password"; // Hidden input style
    input.maxLength = 1;
    input.classList.add("pin-input");

    input.setAttribute("readonly", true);
    input.style.caretColor = "transparent";

    container.appendChild(input);
}

// Now select the dynamically created inputs
const inputs = document.querySelectorAll(".pin-input");

// Add event listeners for auto-focus
inputs.forEach((input, index) => {
    input.addEventListener("input", (e) => {
        if (e.target.value && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }
    });

    input.addEventListener("keydown", (e) => {
        if (e.key === "Backspace" && !e.target.value && index > 0) {
            inputs[index - 1].focus();
        }
    });
});

// Function to handle button click
function handleClick(value) {
    if (value === "X") {
        // Remove last entered digit
        for (let i = inputs.length - 1; i >= 0; i--) {
            if (inputs[i].value !== "") {
                inputs[i].value = "";
                inputs[i].focus();
                break;
            }
        }
    } else if (value !== ">") {
        // Find the first empty input and fill it
        for (let i = 0; i < inputs.length; i++) {
            if (inputs[i].value === "") {
                inputs[i].value = value;
                if (i < inputs.length - 1) {
                    inputs[i + 1].focus();
                }
                break;
            }
        }
    }

    // Check if all inputs are filled, then alert the PIN
    let pin = Array.from(inputs).map(input => input.value).join("");
    if (value === ">" && pin.length !== 4) {
        errorTrigger();
    }
    else if (pin.length === 4){
        const frm = document.getElementById("formContainer");
        const pinContainer = document.createElement("input");
        pinContainer.type = "hidden";
        pinContainer.value = pin;
        pinContainer.name = "pin";
        frm.appendChild(pinContainer);

    }
}

function errorTrigger() {
    // Add error class to trigger animation
    document.querySelectorAll(".pin-input").forEach(input => {
        input.classList.add("error");
    });

    // Remove the class after the animation duration (500ms)
    setTimeout(() => {
        document.querySelectorAll(".pin-input").forEach(input => {
            input.classList.remove("error");
        });
    }, 500);

    document.querySelectorAll(".pin-input").forEach(input => {
        input.value="";
    });
}

// Generate buttons dynamically
buttonValues.forEach((value) => {
    
    const btnContainer = document.createElement("div");
    btnContainer.classList.add("btn-container");

    const button = document.createElement("button");
    button.textContent = value;

    // Attach event listener
    button.addEventListener("click", () => handleClick(value));

    // Append button to its container
    if (value ===">"){
        const frmContainer = document.createElement("form");
        frmContainer.id = "formContainer";
        frmContainer.method = "post";
        frmContainer.action = "";
        button.type = "submit";
        frmContainer.appendChild(button);
        btnContainer.appendChild(frmContainer);
    }
    else {
        btnContainer.appendChild(button);
    }
    keysContainer.appendChild(btnContainer);


});
