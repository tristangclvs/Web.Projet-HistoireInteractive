let cards = document.getElementById("cards");
let category_cards_item = document.getElementsByClassName("category-cards-item");
let actualRotate = 0;
//premier effacement des titres
let pageActuelle = location.href.split("/").pop();


if (pageActuelle == 'liste_test.php'){
    category_cards_item[0].firstElementChild.style.display = "block";
    category_cards_item[1].firstElementChild.style.display = "none";
    category_cards_item[2].firstElementChild.style.display = "none";

}

function showAndHide(actualRotate) {
    if (actualRotate % 360 == 0) {
        category_cards_item[0].firstElementChild.style.display = "block";
        category_cards_item[1].firstElementChild.style.display = "none";
        category_cards_item[2].firstElementChild.style.display = "none";
        console.log("le if");
    }
    /*
    else{
        category_cards_item[0].firstElementChild.style.display = "none";
        category_cards_item[1].firstElementChild.style.display = "block";
        category_cards_item[2].firstElementChild.style.display = "none";
        console.log("le else");
    }*/

    else if (actualRotate % (360/cards.childElementCount)==0) {
        category_cards_item[0].firstElementChild.style.display = "none";
        category_cards_item[1].firstElementChild.style.display = "block";
        category_cards_item[2].firstElementChild.style.display = "none";
        console.log(2*(360/cards.childElementCount));
    }
    else if (actualRotate % (360/(2*cards.childElementCount))==0) {
        console.log("2*(360/cards.childElementCount)")
        category_cards_item[0].firstElementChild.style.display = "none";
        category_cards_item[1].firstElementChild.style.display = "none";
        category_cards_item[2].style.display = "block";
    }
}


function carousel(){ //Fonction click carousel
    console.log("----");
    let st = window.getComputedStyle(cards, null);
    let matrix = st.getPropertyValue("transform");

    /*cards.style.animation="animationCarousel 10s infinite cubic-bezier(0.77, 0, 0.175, 1) forwards";*/
    let pi = Math.PI;
    let values = matrix.split('(')[1].split(')')[0].split(','),
        sinB = parseFloat(values[8]),
        b = Math.round(Math.asin(sinB) * 180 / pi),
        cosB = Math.cos(b * pi / 180),
        tan = sinB/cosB,
        d= Math.atan2(sinB, cosB),
        c = Math.atan(tan);
    // b = Math.round(Math.asin(sinB) * 180 / pi);
    //b = Math.atan2(sinB, cosB);
    console.log(c);
    console.log(b);

    cards.classList.add("active");
    console.log (cards.style.transform);
    let actualRotate = cards.style.transform.split(' '); //[1].split("(")[1].split("d")[0];
    if (actualRotate.length!=1) // gérer l'exception à la première rotation
    {
        actualRotate = cards.style.transform.split(' ')[1].split("(")[1].split("d")[0];
    }
    else
    {
        actualRotate = 0;
    }
    console.log(actualRotate);
    cards.style.transform= (`translateZ(-35vw) rotateY(${parseInt(actualRotate)+(360/cards.childElementCount)}deg)`); //(actualRotate)+120
//    cards.style.transform.replace(cards.style.transform.split(" ")[1],"translateX(10px)");
    setTimeout(function ()  { showAndHide(actualRotate+(360/cards.childElementCount)); },4850);
    //setTimeout(function ()  { console.log(actualRotate); },4850);
}


let variable = 1;
// Au clic du bouton on ajoute ...
if (pageActuelle == "paragraphe_ajout.php") {
    const bouton = document.getElementById('boutonAjoutLien');
    bouton.addEventListener('click', (event) => {
        variable += 1;
        ajoutLien();
    });
}

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

let spanA = document.getElementById('spanA');
let spanB = document.getElementById('spanB');
let spanC = document.getElementById('spanC');
let lienTitre = document.getElementById('baliseb');
lienTitre.addEventListener("mouseover",()=>{
    spanA.style.left = "115px";
    spanA.style.width = "90px";

    spanB.classList.replace("text-dark","text-white");

    spanC.classList.replace("text-white","text-dark");
})
lienTitre.addEventListener("mouseout",()=>{
    spanA.style.left = "0";
    spanA.style.width = "113px";

    spanB.classList.replace("text-white","text-dark");

    spanC.classList.replace("text-dark","text-white");
})
