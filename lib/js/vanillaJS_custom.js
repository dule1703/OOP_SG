function proveriJMBG(str) {
    if (str.length === 0)
    {
        document.getElementById("ajax_text_jmbg").innerHTML = "";
        return;
    } else {
        let xmlhttp = new XMLHttpRequest();
        let text;
        let jmbg;

        xmlhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                text = document.getElementById("ajax_text_jmbg").innerHTML = this.responseText;
                jmbg = document.getElementById("jmbg");
                voiceBtn = document.getElementById("voice-btn");
                if (text !== "") {
                    voiceBtn.setAttribute("disabled", "disabled");
                    console.log("Invalid!!");
                } else {
                    voiceBtn.removeAttribute("disabled");
                    console.log("Valid!");
                }
            }
        };
        xmlhttp.open("GET", "../controllers/php_ajax_scripts/selectJMBG.php?q=" + str, true);
        xmlhttp.send();
    }

}

function proveriTel(str) {
    if (str.length === 0)
    {
        document.getElementById("ajax_text_tel").innerHTML = "";
        return;
    } else {
        let xmlhttp = new XMLHttpRequest();
        let text;
        let jmbg;
        let voiceBtn;

        xmlhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                text = document.getElementById("ajax_text_tel").innerHTML = this.responseText;
                jmbg = document.getElementById("telefon");
                voiceBtn = document.getElementById("voice-btn");
                if (text !== "") {
                    voiceBtn.setAttribute("disabled", "disabled");                    
                } else {
                    voiceBtn.removeAttribute("disabled");                    
                }
            }
        };
        xmlhttp.open("GET", "../controllers/php_ajax_scripts/selectTel.php?q=" + str, true);
        xmlhttp.send();
    }

}


function izaberiNosiocaGl(strMesto) {
    const opstina = document.getElementById("opstina");
    const nosilac = document.getElementById("nosilac_glasova");
    const ime_nosioca = document.getElementById("ime_nosioca_glasova"); 
    const voiceBtn = document.getElementById("voice-btn");

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {

            let option = this.responseText;            
 
            if (opstina.value === "0") {
                nosilac.setAttribute("disabled", "disabled");               
                nosilac.selectedIndex = 0;
                ime_nosioca.setAttribute("disabled", "disabled");
                ime_nosioca.options[0] = new Option("Изаберите име носиоца гласова...", "0");
                ime_nosioca.selectedIndex = 0;      
                voiceBtn.setAttribute("disabled", "disabled");
                
            } else if(option !== ""){
                voiceBtn.removeAttribute("disabled");
                nosilac.removeAttribute("disabled");
                if (nosilac.options.length >= 3) {
                    nosilac.remove(nosilac.options.length - 1);//prevent repeat adding option 3
                }
                nosilac.options[nosilac.options.length] = new Option("Да, имам носиоца", "Да, имам носиоца");
            }else{
                voiceBtn.removeAttribute("disabled");
                nosilac.removeAttribute("disabled");
                nosilac.remove(2);
                ime_nosioca.setAttribute("disabled", "disabled");
                ime_nosioca.options[0] = new Option("Изаберите име носиоца гласова...", "0");
                ime_nosioca.selectedIndex = 0;   
            }
        }
    };

    xmlhttp.open("GET", "../controllers/php_ajax_scripts/selectNosiociGlasova.php?q=" + strMesto, true);
    xmlhttp.send();
}

function izaberiNosioca() {

    const opstina = document.getElementById("opstina");
    const opstina_naziv = opstina.options[opstina.selectedIndex].text;
    const nosilac = document.getElementById("nosilac_glasova");
    const ime_nosioca = document.getElementById("ime_nosioca_glasova");


    if (nosilac.value === "Да, имам носиоца") { //if selec option Да, имам носиоца
        for (let i = ime_nosioca.options.length - 1; i >= 0; i--) {//empty select option
            ime_nosioca.removeChild(ime_nosioca.options[i]);
        }

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                let option = "";
                option = this.responseText;
                console.log(option);

                let options = option.split(",");// split string after ','
                options.splice(-1, 1);//remove last element in every string ','
                if (ime_nosioca.value === 0) {
                    ime_nosioca.remove(0);
                }

                for (let i = 0; i < options.length; i++) {
                    ime_nosioca.options[ime_nosioca.options.length] = new Option(options[i]);//load select element Име носиоца гласова
                }
              
                ime_nosioca.removeAttribute("disabled");
               
            }
        };

        xmlhttp.open("GET", "../controllers/php_ajax_scripts/selectNosiociGlasova.php?q=" + opstina_naziv, true);
        xmlhttp.send();
    } else {
        for (let i = ime_nosioca.options.length - 1; i >= 0; i--) {//empty select option
            ime_nosioca.removeChild(ime_nosioca.options[i]);
        }
        ime_nosioca.options[0] = new Option("Изаберите име носиоца гласова...", "0");
        ime_nosioca.setAttribute("disabled", "disabled");
    }

}


