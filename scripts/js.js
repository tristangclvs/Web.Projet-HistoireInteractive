let cards = document.getElementById("cards");
let category_cards_item = document.getElementsByClassName("category-cards-item");
let actualRotate = 0;

//premier effacement des titres
let pageActuelle = location.href.split("/").pop(); // sert à savoir dans quelle page on se situe


let variable = 1;
// Au clic du bouton on ajoute ...
if (pageActuelle == "paragraphe_ajout.php") {
    const bouton = document.getElementById('boutonAjoutLien');
    bouton.addEventListener('click', (event) => {
        variable += 1;
        ajoutLien();
    });
}

if (pageActuelle == 'paragraphe_ajout.php'){
    let suiteParag = document.getElementById('suiteParag');
    let choix = document.getElementById('choixSuite');
    choix.addEventListener('change',()=>{
        if (choix.value == "continuer"){
            suiteParag.style.display = "block";
        }
        else{
            suiteParag.style.display = "none";
        }
    })
}
if (pageActuelle.split("?")[0] == 'paragraphe.php'){
    let btnZoomPlus = document.getElementById('btnZoom+');
    let btnZoomMoins = document.getElementById('btnZoom-');

    let text = document.getElementsByTagName("p")[0];
    let sizeBody = window.getComputedStyle(text).getPropertyValue('font-size');

    let h2 = document.getElementsByTagName("h2")[0];
    let sizeH2 = window.getComputedStyle(h2).getPropertyValue('font-size');

    let fontSizeBody = parseFloat(sizeBody);
    let fontSizeH2 = parseFloat(sizeH2);
    btnZoomPlus.addEventListener('click',()=>{
        fontSizeBody +=1;
        fontSizeH2 +=1;

        text.style.fontSize = fontSizeBody + "px";
        h2.style.fontSize = fontSizeH2 + "px";
    });
    btnZoomMoins.addEventListener('click',()=>{
        fontSizeBody -=1;
        fontSizeH2 -=1;

        text.style.fontSize = fontSizeBody + "px";
        h2.style.fontSize = fontSizeH2 + "px";
    });
}



let spanA = document.getElementById('spanA');
let spanB = document.getElementById('spanB');
let spanC = document.getElementById('spanC');
let lienTitre = document.getElementById('baliseb');
lienTitre.addEventListener("mouseover",()=>{
    spanA.style.left = "118px";
    spanA.style.width = "82px";

    spanB.classList.replace("text-dark","text-white");

    spanC.classList.replace("text-white","text-dark");
})
lienTitre.addEventListener("mouseout",()=>{
    spanA.style.left = "0";
    spanA.style.width = "113px";

    spanB.classList.replace("text-white","text-dark");

    spanC.classList.replace("text-dark","text-white");
})



function ajoutLien(){
    let formParag = document.getElementById("formParag");
    let divNouveauxLiens = document.getElementById("nouveauxLiens");

    let divProchainAction = document.createElement("div");
    divProchainAction.classList.add("mb-3");
    divNouveauxLiens.appendChild(divProchainAction);

    let labelAction = document.createElement("label");
    labelAction.setAttribute("for", `FormAction${variable}`);
    labelAction.classList.add("form-label");
    labelAction.innerText = "Nom de l'action";

    let inputAction = document.createElement("input");
    inputAction.setAttribute("type", "text");
    inputAction.setAttribute("name", `titre_parag${variable}`);
    inputAction.setAttribute("id", `FormAction${variable}`);
    inputAction.setAttribute("placeholder", "Nom de l'action");
    inputAction.classList.add("form-control");

    //ajout de l'action
    divProchainAction.appendChild(labelAction);
    divProchainAction.appendChild(inputAction);

    ////////////////////////////////////////////////////////////////////

    // div générale du numéro
    let divProchainNumero = document.createElement("div");
    divProchainNumero.classList.add("mb-3");
    divNouveauxLiens.appendChild(divProchainNumero);

    //label et input du numéro de paragraphe
    let labelNumero = document.createElement("label");
    labelNumero.setAttribute("for", `ParagNumero${variable}`);
    labelNumero.classList.add("form-label");
    labelNumero.innerText = "Numéro du paragraphe"

    let inputNumero = document.createElement("input");
    inputNumero.setAttribute("type", "number");
    inputNumero.setAttribute("name", `numero_parag_cible${variable}`);
    inputNumero.setAttribute("id", `ParagNumero${variable}`);
    inputNumero.setAttribute("placeholder", "Numéro du paragraphe");
    inputNumero.classList.add("form-control");
    //ajout du numéro paragraphe
    divProchainNumero.appendChild(labelNumero);
    divProchainNumero.appendChild(inputNumero);


    let divider = document.createElement("div");
    divider.classList.add("dropdown-divider","bg-light", "mb-3");
    divNouveauxLiens.appendChild(divider);
}

