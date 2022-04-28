let cards = document.getElementById("cards");


function test(){
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