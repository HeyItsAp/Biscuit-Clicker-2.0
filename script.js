// 

    // Universal

        //
var pathtopage = window.location.pathname
var page = pathtopage.split("/").pop();
console.log("Script connected");
console.log("Site: " + page)


// 

    // Main Game

        //


var biscuitCount = 0;
var biscuitprestige = 0;


var incrementvalue = 1;
var biscuitauto = 0;
var prestige_req = 100000;

function incrementcount(event) {
  biscuitCount += incrementvalue;
  UpdateBiscuitCount();
  UpdatePrestige();

  let clicker_biscuit = document.getElementById('clicker-biscuit');

  let clicker_offset = clicker_biscuit.getBoundingClientRect();
  let position = {
    x: event.pageX - clicker_offset.left + (50 - Math.random() * 100),
    y: event.pageY - clicker_offset.top + (50 - Math.random() * 100)
  }

  let number = document.createElement('div');
  number.className = "position-absolute z-3 text-black fs-3";
  // Not clickable
  number.style.pointerEvents = "none";
  number.style.userSelect = "none";

  number.innerHTML = incrementvalue;
  number.style.left = position.x + "px";
  number.style.top = position.y + "px";


  // Debugging statements
    // console.log("Parent size:", clicker_biscuit.offsetWidth, clicker_biscuit.offsetHeight);
    // console.log("Child size:", number.offsetWidth, number.offsetHeight);

  // Animation / movement

    let speed_modifier = 1;    // More is faster, less is slower

    let change_in_direction = 0.1;
    setInterval(() =>{
      change_in_direction = (change_in_direction + (3 * speed_modifier));
      position.y = position.y - change_in_direction;
      number.style.top = position.y + "px";
    }, 10)

    let opacity = 1;
    setInterval(() =>{
      opacity = (opacity - (0.1 * speed_modifier));
      number.style.opacity = opacity;
      if (opacity <= 0){
         number.remove();
      }
    }, 10)

  clicker_biscuit.appendChild(number);
}


    if (page == "index.php" || page == "") {
      setInterval(() => {
        for (let element of Upgrades){
          biscuitCount += Math.round((element.value*element.antal) * 100) / 100
        }
        UpdateBiscuitCount();
        UpdatePrestige();

        console.log("Biscuit count: " + biscuitCount)
      }, 1000)
      function UpdateBiscuitCount(){
        let biscuitCountElement = document.getElementById("biscuit-count");
        biscuitCountElement.innerHTML = biscuitCount;
      }
    }
function UpdateBiscuitAuto(){
  let biscuitautoElement = document.getElementById("biscuit-auto-h2");
  biscuitautoElement.innerHTML = "Biscuits per second: <span id='biscuit-auto'>0</span>";
  biscuitauto = 0;
  for (let element of Upgrades){
    let autovalue = Math.round((element.value*element.antal) * 100) / 100
    biscuitauto += autovalue
  }
  document.getElementById("biscuit-auto").innerHTML = biscuitauto;
}
let calc_biscuitprestige = 0;
function UpdatePrestige(){
  calc_biscuitprestige = Math.round((biscuitCount/prestige_req) * 100) / 100;
  if (calc_biscuitprestige >= 1 && !showprestigeoption.called) {
    showprestigeoption();
    document.getElementById("calc_prestige").innerHTML = calc_biscuitprestige;
  } else if (showprestigeoption.called){
    document.getElementById("calc_prestige").innerHTML = calc_biscuitprestige;
  }
}
      function showprestigeoption(){
        showprestigeoption.called = true;
        let prestigeElement = document.getElementById("prestige-menu");
        
        let prestigetext = document.createElement("p");
        prestigetext.innerHTML = "You can Biscuit Prestige (BP) and get: <span id='calc_prestige'></span>";
        prestigeElement.appendChild(prestigetext);

        let prestige_stats = document.createElement("p");
        prestige_stats.innerHTML = "Currently you have: <span id='prestige'>" + biscuitprestige + "</span> BP";
        prestigeElement.appendChild(prestige_stats);
        
        let prestige_button = document.createElement("button");
        prestige_button.setAttribute("class", "prestige-btn")
        prestige_button.innerHTML = "<span class='bold-text'> Prestige </span>";
        prestigeElement.appendChild(prestige_button);
        prestige_button.addEventListener("click", () => {
          console.log("Reset");
          showprestigeoption.called = false;
          console.log(orignalupgrade)
          Upgrades = orignalupgrade
          console.log(Upgrades);
          biscuitCount = 0;
          UpdateBiscuitCount();
          biscuitauto = 0;
          RefreshUpgradesElem();
          UpdateBiscuitAuto();
          prestigetext.remove();
          prestige_stats.remove();
          biscuitprestige = biscuitprestige + calc_biscuitprestige;
          calc_biscuitprestige = 0;
          prestige_button.remove();
          biscuitprestige = biscuitprestige + calc_biscuitprestige;
          console.log(biscuitprestige);  
        });

      }

  // Upgrades
// Can be modified 
var Upgrades = [
  {
    navn: "Better sleep",
    headline: "Get better sleep",
    unlocked: true,
    antal: 0,
    value: 0.5,
    cost: 50,
    des: "Sleeping more makes you make more. <br><span class='bold-text'> Gain 0.5 Cookie pr second</span>"
  },
  {
    navn: "Dinner every day",
    headline: "Eat more",
    unlocked: false,
    antal: 0,
    value: 2,
    cost: 200,
    des: "With the biscuits your making, you can finally but some good food. <br><span class='bold-text'> Gain 2 Cookie pr second</span>"
  },
  {
    navn: "Education",
    headline: "Actually learn lol",
    unlocked: false,
    antal: 0,
    value: 20,
    cost: 1000,
    des: "Go back to elementary school and learn the basics. <br><span class='bold-text'> Gain 20 Cookie pr second</span>"
  },
  {
    navn: "Extra lessons",
    headline: "Extra steps",
    unlocked: false,
    antal: 0,
    value: 50,
    cost: 2000,
    des: "You lack behind, but with hard work you slowly make way. <br><span class='bold-text'> Gain 50 Cookie pr second</span>"
  },
  {
    navn: "Collage",
    headline: "Big step",
    unlocked: false,
    antal: 0,
    value: 200,
    cost: 5000,
    des: "You go to Collage, your friends respect your leave and run the store <br><span class='bold-text'> Gain 200 Cookie pr second</span>"
  },
  {
    navn: "Working Graduate",
    headline: "Smart boi",
    unlocked: false,
    antal: 0,
    value: 2000,
    cost: 10000,
    des: "You come back with more knowlegde than ever before <br><span class='bold-text'> Gain 2000 Cookie pr second</span>"
  },
  {
    navn: "Political effects",
    headline: "Joe Biden",
    unlocked: false,
    antal: 0,
    value: 9,
    cost: 10,
    des: "The new political polich changes bisnis as a whole <br><span class='bold-text'> Gain 9 Cookie pr second</span>"
  },
  {
    navn: "Chance to expand",
    headline: "I'll Take it!",
    unlocked: false,
    antal: 0,
    value: 10000,
    cost: 5000000,
    des: "You buy local emptu spaces to expand <br><span class='bold-text'> Gain 9 Cookie pr second</span>"
  },
  {
    navn: "Cooperation",
    headline: "Stonks",
    unlocked: false,
    antal: 0,
    value: 200000,
    cost: 100000000,
    des: "You make deals with other bisnisess, and become one big cooperation <br><span class='bold-text'> Gain 9 Cookie pr second</span>"
  },
  {
    navn: "Mr. Biscuit WorldWide",
    headline: "Become Apple",
    unlocked: false,
    antal: 0,
    value: 200000,
    cost: 100000000,
    des: "This is the name of your offical popular World wide cookies<br><span class='bold-text'> Gain 9 Cookie pr second</span>"
  }
];

// Copy with no mods

var orignalupgrade = [
  {
    navn: "Better sleep",
    headline: "Get better sleep",
    unlocked: true,
    antal: 0,
    value: 0.5,
    cost: 50,
    des: "Sleeping more makes you make more. <br><span class='bold-text'> Gain 0.5 Cookie pr second</span>"
  },
  {
    navn: "Dinner every day",
    headline: "Eat more",
    unlocked: false,
    antal: 0,
    value: 2,
    cost: 200,
    des: "With the biscuits your making, you can finally but some good food. <br><span class='bold-text'> Gain 2 Cookie pr second</span>"
  },
  {
    navn: "Education",
    headline: "Actually learn lol",
    unlocked: false,
    antal: 0,
    value: 20,
    cost: 1000,
    des: "You actually learn how to cook :skull: <br><span class='bold-text'> Gain 20 Cookie pr second</span>"
  },
  {
    navn: "Extra lessons",
    headline: "Extra steps",
    unlocked: false,
    antal: 0,
    value: 50,
    cost: 2000,
    des: "Go back to elmentary school and learn the basics <br><span class='bold-text'> Gain 50 Cookie pr second</span>"
  },
  {
    navn: "Collage",
    headline: "Big step",
    unlocked: false,
    antal: 0,
    value: 200,
    cost: 5000,
    des: "You go to Collage, your friends respect your leave and run the store <br><span class='bold-text'> Gain 200 Cookie pr second</span>"
  },
  {
    navn: "Working Graduate",
    headline: "Smart boi",
    unlocked: false,
    antal: 0,
    value: 2000,
    cost: 10000,
    des: "You come back with more knowlegde than ever before <br><span class='bold-text'> Gain 2000 Cookie pr second</span>"
  },
  {
    navn: "Political effects",
    headline: "Joe Biden",
    unlocked: false,
    antal: 0,
    value: 9,
    cost: 10,
    des: "The new political polich changes bisnis as a whole <br><span class='bold-text'> Gain 9 Cookie pr second</span>"
  },
  {
    navn: "Chance to expand",
    headline: "I'll Take it!",
    unlocked: false,
    antal: 0,
    value: 10000,
    cost: 5000000,
    des: "You buy local emptu spaces to expand <br><span class='bold-text'> Gain 9 Cookie pr second</span>"
  },
  {
    navn: "Cooperation",
    headline: "Stonks",
    unlocked: false,
    antal: 0,
    value: 200000,
    cost: 100000000,
    des: "You make deals with other bisnisess, and become one big cooperation <br><span class='bold-text'> Gain 9 Cookie pr second</span>"
  },
  {
    navn: "Mr. Biscuit WorldWide",
    headline: "Become Apple",
    unlocked: false,
    antal: 0,
    value: 200000,
    cost: 100000000,
    des: "This is the name of your offical popular World wide cookies<br><span class='bold-text'> Gain 9 Cookie pr second</span>"
  }
];


function RefreshUpgradesElem(){
  let upgradeparent = document.getElementById("The-upgrades-menu");
  let upgradeelements = upgradeparent.querySelectorAll("div");
  console.log("Refreshing Upgrades");
  for (let index = 0; index < upgradeelements.length; index++){
    upgradeelements[index].remove();
  } 
  for (let element of Upgrades){
    if (element.unlocked == true){
      CreateUpgrade(element)
    }
  }
}
if (page == "index.php" || page == ""){
  RefreshUpgradesElem();
  UpdateBiscuitCount();

}

function CreateUpgrade(element) {
  let Upgrade_div = document.createElement("div")
    Upgrade_div.setAttribute("id", "Upgrade-" + element.navn)
    Upgrade_div.setAttribute("class", "list-group-item p-3 my-1 d-flex flex-row justify-content-between w-100 btn border-0")
    Upgrade_div.style.backgroundColor = "#FFD700"
    document.getElementById("The-upgrades-menu").appendChild(Upgrade_div)
    
    let upgradeheadline = document.createElement("div")
      upgradeheadline.setAttribute("class", "p-1")
      upgradeheadline.setAttribute("id", "upgradeheadline-" + element.navn)
      document.getElementById("Upgrade-" + element.navn).appendChild(upgradeheadline)
      
      let Upgrade_h2 = document.createElement("h2")
        Upgrade_h2.innerHTML = element.navn
        upgradeheadline.setAttribute("class", "")
        document.getElementById("upgradeheadline-" + element.navn).appendChild(Upgrade_h2)
      let Upgrade_headline = document.createElement("p")
        Upgrade_headline.innerHTML = element.headline
        Upgrade_headline.setAttribute("class", "text-start mb-1")
        document.getElementById("upgradeheadline-" + element.navn).appendChild(Upgrade_headline)
      let Upgrade_price = document.createElement("p")
        Upgrade_price.setAttribute("id", "price-"+ element.navn)
        Upgrade_price.innerHTML = element.cost 
        Upgrade_price.setAttribute("class", "text-start mb-1 text-decoration-underline fs-3")
        Upgrade_price.style.color = "#8B4513"
        document.getElementById("upgradeheadline-" + element.navn).appendChild(Upgrade_price)


  

    let upgrade_info_div = document.createElement("div")
      upgrade_info_div.setAttribute("class", "d-flex flex-column justify-content-center align-items-center")
      upgrade_info_div.setAttribute("id", "upgrade-info-" + element.navn)
      document.getElementById("Upgrade-" + element.navn).appendChild(upgrade_info_div)

      let Upgrade_amount = document.createElement("h3")
        Upgrade_amount.setAttribute("id", "antal-" + element.navn)
        Upgrade_amount.innerHTML = element.antal;
        document.getElementById("upgrade-info-" + element.navn).appendChild(Upgrade_amount)


    Upgrade_div.addEventListener("click", () => {
      console.log("Click")
      if (biscuitCount >= element.cost){
        // Neste upgrade unlocked
        let currentUpgrade = Upgrades.indexOf(element);
        if (Upgrades[currentUpgrade+1] != undefined){
          Upgrades[currentUpgrade+1]["unlocked"] = true;
        }
        console.log("Nothing 2")

        RefreshUpgradesElem();
        // Oppdater text og data
        biscuitCount = biscuitCount - element.cost
        element.antal++;
        element.cost = Math.round(element.cost * 1.5);
        UpdateBiscuitCount();
        UpdateBiscuitAuto();
        document.getElementById("price-" + element.navn).innerHTML = element.cost
        document.getElementById("antal-" + element.navn).innerHTML = element.antal
        

      } else {
        console.log(biscuitCount, element.cost, element.antal);
        return triggermodal("You have enough biscuits to get this update");
      }
    })
      // Example:
      // <div class="upgrade">
      //   <div class="upgradeheadline">
      //       <h2> More sleep</h2>
      //       <p> Sleeping more makes you make more <span class="bold-text"> Gain 0.1 Cookie pr second</span></p>
      //   </div>
      //   <button onclick="buy()">Get more sleep<br>Pris: <span id="price">12</span><br>Antal: <span id="antal">0</span></button>
      // </div>
}




// 

    // Items

        //
  

// Items Data  
var items = [
  //<span class='bold-text'></span> For bold text

  // Trash tier items
  // Fix us
  {
    navn: "Disabled Kid",
    Rarity: "Trash",
    increment_increase: 0,
    beskrivelse: "Poor guy", // Span for bold text
    Obtained: true,
  },
  {
    navn: "Sakura (Fra Naurto)",
    increment_increase: 0,
    Rarity: "Trash",
    beskrivelse: "Annoying Customer", // Span for bold text
    Obtained: true,
  },
  {
    navn: "Santa Claus",
    increment_increase: 0,
    Rarity: "Trash",
    beskrivelse: "Sadly, did not come to give gifts.", // Span for bold text
    Obtained: true,
  },
  
  // Rare items
  {
    navn: "Black hole",
    Rarity: "Rare",
    increment_increase: 25,
    beskrivelse: "You learned how to refine energy and able to extract the energy of a black hole.", // Span for bold text
    Obtained: true,
  },

  {
    navn: "Skibidi Toilet",
    Rarity: "Rare",
    increment_increase: 25,
    beskrivelse: "Premium Toilet.", // Span for bold text
    Obtained: true,
  }, 
  {
    navn: "Whip from the good old times.",
    Rarity: "Rare",
    increment_increase: 50,
    beskrivelse: "The best motivator for any type of workplace.", // Span for bold text
    Obtained: true,
  }, 
  {
    navn: "Chainsaw man",
    Rarity: "Rare",
    increment_increase: 25,
    beskrivelse: "Honest worker, but dumb.", // Span for bold text
    Obtained: true,
  }, 
  {
    navn: "W Rizz.",
    Rarity: "Rare",
    increment_increase: 25,
    beskrivelse: "W Rizz.", // Span for bold text
    Obtained: true,
  }, 
  {
    navn: "Creator's Mother",
    increment_increase: 25,
    Rarity: "Rare",
    beskrivelse: "How the hell is my mom in the game?", // Span for bold text
    Obtained: false,
  },

  // Epic items
  {
    navn: "H Magnus H",
    increment_increase: 250,
    Rarity: "Epic",
    beskrivelse: "Add him on Epic Games.", // Span for bold text
    Obtained: false,
  },
  {
    navn: "Dad's Milk",
    increment_increase: 100,
    Rarity: "Epic",
    beskrivelse: "Your dad came home with premium milk.", // Span for bold text
    Obtained: false,
  },
  {
    navn: "Water bending",
    increment_increase: 100,
    Rarity: "Epic",
    beskrivelse: "Avatar reference.", // Span for bold text
    Obtained: false,
  },
  // Legendary 
  {
    navn: "Ni-ho-di",
    increment_increase: 5000,
    Rarity: "Legendary",
    beskrivelse: "Good job. You won.", // Span for bold text
    Obtained: false,
  },
  {
    navn: "Life",
    increment_increase: 2000,
    Rarity: "Legendary",
    beskrivelse: "You finally go outside.", // Span for bold text
    Obtained: false,
  }
]
if (page == "items.php") {
  function CreateItem(element) {
    let Item_div= document.createElement("div")
    Item_div.setAttribute("id", "Item-" + element.navn)
    Item_div.setAttribute("class", "col-8 col-lg-4 col-xl-3")
    document.getElementById("items").appendChild(Item_div)

      let Item_card = document.createElement("div")
      Item_card.setAttribute("id", "Item-card-" + element.navn)
      Item_card.setAttribute("class", "card border-1")
      document.getElementById("Item-" + element.navn).appendChild(Item_card)

        let card_body = document.createElement("div")
        card_body.setAttribute("id", "card-body-" + element.navn)
        card_body.setAttribute("class", "card-body text-center p-0 ")


        document.getElementById("Item-card-" + element.navn).appendChild(card_body)

          let card_header = document.createElement("div");
          card_header.setAttribute("class", "card-header text-center text-primary");
          card_header.innerHTML = element.Rarity;
          document.getElementById("card-body-" + element.navn).appendChild(card_header);

          let Item_h2 = document.createElement("h2")
          Item_h2.innerHTML = element.navn
          Item_h2.setAttribute("class", "card-title py-3 fs-3 px-2")
          document.getElementById("card-body-" + element.navn).appendChild(Item_h2)

          let Item_des = document.createElement("p")
          Item_des.innerHTML = element.beskrivelse
          Item_des.setAttribute("class", "card-text mx-5 text-muted")
          document.getElementById("card-body-" + element.navn).appendChild(Item_des)

          let card_footer = document.createElement("div");
          card_footer.innerHTML = "+ " + element.increment_increase + " Biscuit on Click";
          card_footer.setAttribute("class", "card-footer");
          document.getElementById("card-body-" + element.navn).appendChild(card_footer)
          

      // Eksempel: 
      // <div class="col-8 col-lg-4 col-xl-3">
      //   <div class="card border-0"><!-- No card border-->
      //       <div class="card-body text-center py-4"><!-- The content-->
      //           <h4 class="card-title">Example lel</h4>
      //           <p class="lead card-subtitle">Subtitle</p>
      //           <p class="display-5 my-4 text-primary fw-bold"> Lorem.</p>
      //           <p class="card-text mx-5 text-muted d-none d-lg-block">Lorem ipsum dolor sit amet.</p>
      //           <a href="#" class="btn btn-outline-primary btn-lg mt-3">Buy reithg noew</a>
      //       </div>
      //    </div>
      // </div>
    }
    function CreateItems(items_array) {
      let you_have_an_item = false;
      for (let element of items_array) {
          if (element.Obtained == true || element.Obtained == "true") {
            console.log(element.navn + " = true")
            you_have_an_item = true;
            CreateItem(element)
          } else {
            console.log(element.navn + " = false")
          }
      }
      if (you_have_an_item == false){
        let Item_div= document.createElement("div")
        Item_div.setAttribute("id", "Items-Nothing")
        Item_div.setAttribute("class", "item-container")
        document.getElementById("items").appendChild(Item_div)
    
          let Item_h2 = document.createElement("h2")
          Item_h2.innerHTML = "You have no items"
          document.getElementById("Items-Nothing").appendChild(Item_h2)
      }
    }  
 
}
function Updateincrementvalue(){
  for (let element of items) {
    if (element.Obtained == true || element.Obtained == "true"){
      incrementvalue += element.increment_increase
    }
  } 
  if (page == "items.php"){
    document.getElementById("increment_value").innerHTML = "Currently, you make " + incrementvalue + " pr click";
  }
}
// 

    // Summons

        //
let Summonreq = 10;

// Bascailly the pulling mecanhic
function pullRarity() {

  // Random number generator
  const randomNumber = Math.random() * 100;
  
  const trashProbability = 60;
  const rareProbability = 35;
  const epicProbability = 4;
  const LegendaryProbability = 1;
  if (randomNumber < trashProbability){
    return items.filter(items => items.Rarity === "Trash");
  } else if (randomNumber <= (rareProbability + trashProbability)) {
    return items.filter(items => items.Rarity === "Rare");
  } else if (randomNumber <= (rareProbability + epicProbability + trashProbability)) {
    return items.filter(items => items.Rarity === "Epic");
  } else if (randomNumber <= (rareProbability + epicProbability + trashProbability + LegendaryProbability)){
    return items.filter(items => items.Rarity === "Legendary");
  }
}
function pullItem(){
  if (biscuitprestige >= Summonreq){
  biscuitprestige = biscuitprestige - Summonreq;

  document.getElementById("Stats").innerHTML = "You have: " + biscuitprestige + " BP <br> For one summon: " + Summonreq + " BP <br>";

  // Reset
    document.getElementById("result-text").style.display = 'none';
    document.getElementById("result-text").innerHTML = '';
    document.getElementById('result-text').className = '';
  
  const Rarity_array = pullRarity();
  console.log(Rarity_array)
    // if (Rarity_array.length == 1) {
    //   var random_index = 0;
    // } else {
    //   var random_index = Math.floor(Math.random() * Rarity_array.length);
    // }
  var random_index = Math.floor(Math.random() * Rarity_array.length);
  document.getElementById("summon-button").style.display = 'none';
  // Display result
    var video = document.createElement("video");
      video.setAttribute("autoplay", "");
      video.setAttribute("id", "video");
      document.getElementById("result").appendChild(video);
        let source = document.createElement("source");
        source.setAttribute("type", "video/mp4");
          if (Rarity_array[random_index].Rarity === "Trash"){
            console.log("TRash");
            source.setAttribute("src", "Medium/3star_animation.mp4");
          }  else if (Rarity_array[random_index].Rarity === "Rare"){
            console.log("Rare");
            source.setAttribute("src", "Medium/3star_animation.mp4");
          }  else if (Rarity_array[random_index].Rarity === "Epic"){
            console.log("Epic");
            source.setAttribute("src", "Medium/4star_animation.mp4");
          }  else if (Rarity_array[random_index].Rarity === "Legendary"){
            console.log("Legedary");
            source.setAttribute("src", "Medium/5star_animation.mp4");
          }
          video.appendChild(source);
      // Prevent scrolling
      document.body.style.height = "100%"
      document.body.style.overflow = "hidden"
    

    video.addEventListener('ended', () => {
      // Ending
      let videoElement = document.getElementById("video");
      videoElement.remove();
      document.getElementById("result-text").style.display = 'block';
      if (Rarity_array[random_index].Obtained == "true"){
        document.getElementById("result-text").innerHTML = 'You got: ' + Rarity_array[random_index].navn + ' <br> (Already Own)<br> Rarity: ' + Rarity_array[random_index].Rarity;
      } else {
        document.getElementById("result-text").innerHTML = 'You got: ' + Rarity_array[random_index].navn + ' <br> Rarity: ' + Rarity_array[random_index].Rarity;
      }
      document.getElementById('result-text').className = 'animation';
      document.body.style.height = "auto"
      document.body.style.overflow = "auto"
      document.getElementById('result-text').addEventListener("animationend", () => {
        document.getElementById("summon-button").style.display = 'block';
        save_item(Rarity_array[random_index]);
      })

    });
    video.addEventListener('play', function() {
      // Try to request fullscreen when the video starts playing
      if (video.requestFullscreen) {
        video.requestFullscreen();
      } else if (video.mozRequestFullScreen) { // Firefox
        video.mozRequestFullScreen();
      } else if (video.webkitRequestFullscreen) { // Chrome, Safari and Opera
        video.webkitRequestFullscreen();
      } else if (video.msRequestFullscreen) { // IE/Edge
        video.msRequestFullscreen();
      }
    });

  } else { 
    document.getElementById("Error-msg").innerHTML = 'Not enough';
  }
}
// 

    // To PHP / From PHP

        //

// Logging in
let isloggedinn = document.querySelector("meta[name='Login']").content;

console.log("Is logged inn:" + isloggedinn);
if (isloggedinn == 1) {
  if (page == "index.php" || page == ""){
    document.getElementById("biscuit-count").innerHTML = "Loading ... ";
  }

  console.log("Logged in: True");
  // if logged in
  $.ajax({
    url: 'php_requires/dataretrive_ajax.php',
    type: 'GET',
    datatype: 'json',
    success: (data) => {
      
        // data is json? Get data anyway
        console.log(data);
        var user_information = JSON.parse(data);
        // console.log(user_information.biscuit_progress[0].biscuit_count);
        console.log(user_information);
        // The second object contains an array

      // Update user progress
        biscuitCount = user_information.biscuit_progress[0].biscuit_count
        biscuitprestige = user_information.biscuit_progress[0].prestige_count
        console.log(biscuitprestige)

    
      // Update user upgrades
        for (var element of Upgrades) {
          let name = element.navn
          // Check if newCosts has a corresponding key
          if (user_information.upgrades[0].hasOwnProperty(name)){
            element.antal = user_information.upgrades[0][name];
            if(user_information.upgrades[0][name] > 0) {
              element.unlocked = true;
              let currentUpgrade = Upgrades.indexOf(element);
              if (Upgrades[currentUpgrade+1] != undefined){
                Upgrades[currentUpgrade+1]["unlocked"] = true;
              }
            }
          }
          for (let i = 0; i < element.antal; i++) {
            element.cost = Math.round(element.cost *1.15);
          }
        }
        if (page == "index.php" || page == ""){
          RefreshUpgradesElem();
          UpdateBiscuitAuto();
          UpdatePrestige();
        }
      // Update items
        for (var element of items) {
          let name = element.navn
          // Check if newCosts has a corresponding key
          if (user_information.items[0].hasOwnProperty(name)){
            element.Obtained = user_information.items[0][name];
          }
        }

        Updateincrementvalue();
        console.log(items)
        // Create items in the items.php
        if (page == "items.php"){
          CreateItems(items); 
          
        }
        console.log(items)
      // Summons
        if (page == "summons.php"){
          document.getElementById("Stats").innerHTML = "You have: " + biscuitprestige + " BP <br> For one summon: " + Summonreq + " BP <br>";
        }
    },
    error: (error) => {
      console.error('Error fetching data:', error)
    }
  });

} else if (isloggedinn == 0) {
  console.log("Logged inn: False");

  //
  // TEMPORARY CODE: USED FOR BOOTSTAP CONFIGURATION ONLY 
  // WHEN LOGGED IN
  //
  if (page == "items.php"){
    CreateItems(items); 
  }
}

// Saving progress
  function save_progress() {
    console.log("Attempt to save progress and upgrades");
    var save_form = document.createElement("form");
    save_form.method = "POST";
    save_form.action = "php_requires/save_progress_h.php";

    for (var i = 0; i < Upgrades.length; i++) {
      var input = document.createElement("input");
      input.type = "hidden";
      input.method = "POST";
      input.name = "upgrades[" + Upgrades[i].navn + "]";
      input.value = Upgrades[i].antal;
      save_form.appendChild(input);
    }
    for (var i = 0; i < 2; i++) {
      if (i == 0){
        var input = document.createElement("input");
        input.type = "hidden";
        input.method = "POST";
        input.name = "biscuit_progress[biscuit_count]";
        input.value = biscuitCount;
        save_form.appendChild(input);
      }
      if (i == 1){
        var input = document.createElement("input");
        input.type = "hidden";
        input.method = "POST";
        input.name = "biscuit_progress[prestige_count]";
        input.value = biscuitprestige;
        save_form.appendChild(input);
      }
    }
    document.body.appendChild(save_form);
    save_form.submit();
  }
// Saving new acquired items
  function save_item(item_object){
    console.log(item_object)
    var save_form = document.createElement("form");
    save_form.method = "POST";
    save_form.action = "php_requires/save_item_h.php";

    var input = document.createElement("input");
    input.type = "hidden";
    input.name = "item[" + item_object.navn + "]";
    input.value = "true";
    save_form.appendChild(input);

    var input_prestige = document.createElement("input");
    input_prestige.type = "hidden";
    input_prestige.name = "prestige_count";
    input_prestige.value = biscuitprestige;
    save_form.appendChild(input_prestige);

    // input.value = true;
    document.body.appendChild(save_form);
    save_form.submit();
  }

// 

    // Modal

        //
function triggermodal (text){
  let vital_text = document.getElementById("vital-text");
  vital_text.innerHTML = text;
  $('#vital_modal').modal('show');
}
