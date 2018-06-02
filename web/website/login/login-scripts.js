// entropy.js MIT License © 2014 James Abney http://github.com/jabney
// ES6 portation MIT License © 2017 Peter Seprus http://github.com/ppseprus

// Calculate the Shannon entropy of a string in bits per symbol.
(function (shannon) {
    'use strict';

    // Create an array of character frequencies.
    const getFrequencies = str => {
        let dict = new Set(str);
        return [...dict].map(chr => {
            return str.match(new RegExp(chr, 'g')).length;
        });
    };

    // Measure the entropy of a string in bits per symbol.
    shannon.entropy = str => getFrequencies(str)
        .reduce((sum, frequency) => {
            let p = frequency / str.length;
            return sum - (p * Math.log(p) / Math.log(2));
        }, 0);

    // Measure the entropy of a string in total bits.
    shannon.bits = str => shannon.entropy(str) * str.length;

    // Log the entropy of a string to the console.
    shannon.log = str => console.log(`Entropy of "${str}" in bits per symbol:`, shannon.entropy(str));

})(window.shannon = window.shannon || Object.create(null));

function validateForm() {
    var isValid = false;
    var usr = $("#username").val();
    var pwd = $("#password").val();
    var pwdC = $("#passwordConf").val();

    if (usr !== "" && pwd !== "" && pwdC !== "") { //check empty values
        if (pwd === pwdC) {
            var entropy = shannon.entropy(pwd);
            if (entropy > 3.3) {
                isValid = true;
            } else {
                $("#errorText").text("Entropy must be greater than 3.3 - please enter a more complex password. Current entropy: " + entropy);
            }
        } else {
            $("#errorText").text("Passwords do not match");
        }
    } else {
        $("#errorText").text("Please enter a username and a password.");
    }

    return isValid;
}

function onNewAccountClick() {
    var form = document.getElementById('loginForm');

    form.action = "new-account.php";
    form.submit();
}