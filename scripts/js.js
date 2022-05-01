let cards = document.getElementById("cards");


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
    if (actualRotate.length!=1)
    {
        actualRotate = cards.style.transform.split(' ')[1].split("(")[1].split("d")[0];
    }
    else
    {
        actualRotate = 0;
    }
    console.log(actualRotate);
    cards.style.transform= (`translateZ(-35vw) rotateY(${parseInt(actualRotate)+120}deg)`);
//    cards.style.transform.replace(cards.style.transform.split(" ")[1],"translateX(10px)");
}
let variable = 1;
// Au clic du bouton on ajoute ...
const bouton = document.getElementById('boutonAjoutLien');
bouton.addEventListener('click',(event)=>{
    variable += 1;
    ajoutLien();
});

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

