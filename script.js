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
    x: event.pageX - clicker_offset.left + (50 - (Math.random() * 100)),
    y: event.pageY - clicker_offset.top + (50 - (Math.random() * 100))
  }

  let number = document.createElement('div');
  number.className = "position-absolute z-3 text-black fs-3";
  // Not clickable
  number.style.pointerEvents = "none";
  number.style.userSelect = "none";

  number.innerHTML = "+" + incrementvalue;
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

        console.log("Autoing: Biscuit count: " + biscuitCount)
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
        prestigeElement.style.display = "flex";
        
        let presitge_getPrestige = document.createElement("p");
        presitge_getPrestige.innerHTML = "You can now get Biscuit Prestige (BP) and get: <span id='calc_prestige' class='fw-bold fs-5'></span> BP ";
        prestigeElement.appendChild(presitge_getPrestige);
        
        let prestige_stats = document.createElement("p");
        prestige_stats.innerHTML = "Currently you have: <span id='prestige' class='fw-bold fs-5'>" + biscuitprestige + "</span> BP";
        prestigeElement.appendChild(prestige_stats);
        
        let prestige_button = document.createElement("button");
        prestige_button.setAttribute("class", "btn rounded px-3")
        prestige_button.style.backgroundColor = "#00FF00";

        prestige_button.innerHTML = "Prestige";
        prestigeElement.appendChild(prestige_button);
        prestige_button.addEventListener("click", () => {
          console.log("Reset");
          showprestigeoption.called = false;
          console.log(orignalupgrade)
          Upgrades = orignalupgrade
          orignalupgrade[0].unlocked = true;
          orignalupgrade[0].antal = 0;

          console.log(Upgrades);
          biscuitCount = 0;
          UpdateBiscuitCount();
          biscuitauto = 0;
          RefreshUpgradesElem();
          UpdateBiscuitAuto();
          prestige_stats.remove();
          biscuitprestige = biscuitprestige + calc_biscuitprestige;
          calc_biscuitprestige = 0;
          presitge_getPrestige.remove();
          prestige_button.remove();
          biscuitprestige = biscuitprestige + calc_biscuitprestige;
          showprestigeoption.called = false;
          prestigeElement.style.display = prestigeElement.style.display === 'none' ? '' : 'none';
          document.getElementById("prestige-show-stats").innerHTML = "Biscuit Prestige: " + biscuitprestige;
          if (isloggedinn == 1) {
            save_progress(false);
          }
          console.log(biscuitprestige);  
        });

      }



// 

    // Upgrades

        //

// Can be modified array:
var Upgrades = []; // Data inserted via ajax/php
  
// Copy with no mods
var orignalupgrade = []; // Data inserted via ajax/php + if logged in


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
    Upgrade_div.setAttribute("class", "list-group-item p-3 my-1 d-flex flex-row justify-content-between w-100 btn border-0 hover")
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
        Upgrade_headline.innerHTML = element.headline + ": + " + element.value + "";
        Upgrade_headline.setAttribute("class", "text-start mb-1")
        document.getElementById("upgradeheadline-" + element.navn).appendChild(Upgrade_headline)
      let Upgrade_price = document.createElement("p")
        Upgrade_price.setAttribute("id", "price-"+ element.navn)
        Upgrade_price.innerHTML = element.cost 
        Upgrade_price.setAttribute("class", "text-start mb-1 fs-3")
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
var items = [] // Data is gotten through ajax
if (page == "items.php") {
  function CreateItem(element) {
    let Item_div= document.createElement("div")
    Item_div.setAttribute("id", "Item-" + element.navn)
    Item_div.setAttribute("class", "col-12 col-lg-4 col-xl-3")
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
    document.getElementById("increment_value").innerHTML = "Currently, you make <span class='fw-bold fs-4 my-2'>" + incrementvalue + " </span> pr click";
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

  document.getElementById("Stats").innerHTML = "You have: <span class='fw-bold fs-1'>" + biscuitprestige + "</span> BP <br> For one summon: " + Summonreq + " BP <br>";

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
        document.getElementById("result-text").innerHTML = Rarity_array[random_index].Rarity + '<br> (Already Own) <br> ' + Rarity_array[random_index].navn;
      } else {
        document.getElementById("result-text").innerHTML = Rarity_array[random_index].navn + ': <br>' + Rarity_array[random_index].Rarity;
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
      triggermodal("Not enough. To summon you need " + Summonreq + ". You have " + biscuitprestige + ".")
  }
}

// 

    // Data Retrival / Sending

        //

// Logged inn???!??!?!
let isloggedinn = document.querySelector("meta[name='Login']").content;
console.log("Is logged inn:" + isloggedinn);


if (isloggedinn == 1) {
  // if logged in
  if (page == "index.php" || page == ""){
    document.getElementById("biscuit-count").innerHTML = "Loading ... ";
  }
  // //////////////////////////
  // True logg inn
  // //////////////////////////

  console.log("Logged in: True");
  $.ajax({
    url: 'php_requires/loginDataretrive_ajax.php',
    type: 'GET',
    datatype: 'json',
    success: (data) => {
      
        console.log(data);
        var user_information = JSON.parse(data);
        // console.log(user_information.biscuit_progress[0].biscuit_count);
        console.log(user_information);

      // Update Biscuit progress
        biscuitCount = user_information["biscuit_progress"][0].biscuit_count;
        biscuitprestige = user_information["biscuit_progress"][0].prestige_count;
      // Auto saving
        auto_saving = user_information["biscuit_progress"][0].auto_saving;
        switch (auto_saving) {
          case 1:
            console.log("Auto saving is enabled");
            if (page == "index.php" || page == ""){
              enable_autosave();
            }
            break
          default:
            console.log("Auto saving is not enabled");
            break
        }
        

    
      // Update user UPGRADES
        user_information["upgrades"].forEach(array => {
          let upgrade_object = {
            id: array.id_upgrades,
            navn: array.upgrade_navn,
            headline: array.upgrade_headline,
            unlocked: false,
            antal: array.upgrade_antall,
            value: array.upgrade_value,
            cost: array.upgrade_cost,
            des: array.upgrade_des
          }
          Upgrades.push(upgrade_object);

          let Reset_upgrade_object = {
            id: array.id_upgrades,
            navn: array.upgrade_navn,
            headline: array.upgrade_headline,
            unlocked: false,
            antal: 0,
            value: array.upgrade_value,
            cost: array.upgrade_cost,
            des: array.upgrade_des
          }
          orignalupgrade.push(Reset_upgrade_object);
        })
        if (page == "index.php" || page == ""){
          document.getElementById("prestige-show-stats").innerHTML = "Biscuit Prestige: " + biscuitprestige;
          Upgrades[0].unlocked = true;
          RefreshUpgradesElem();
          UpdateBiscuitAuto();
          UpdatePrestige();
        }
        console.log(Upgrades);  
    
      // Update user ITEMS
        user_information["items"].forEach(array => {
          let item_object = {
            id: array.id_items,
            navn: array.item_navn,
            increment_increase: array.item_increase,
            Obtained: array.items_obtained,
            Rarity: array.item_rarity,
            beskrivelse: array.item_beskrivelse,
          }
          items.push(item_object);
        })
        Updateincrementvalue();
        // Create items in the items.php
        if (page == "items.php"){
          CreateItems(items); 
        }
        console.log(items)
      // Summons
        if (page == "summons.php"){
          document.getElementById("Stats").innerHTML = "You have: <span class='fw-bold fs-3'>" + biscuitprestige + "</span> BP <br><span class='fs-2'> For one summon: " + Summonreq + " BP </span><br>";
        }
    },
    error: (error) => {
      console.error('Error fetching data:', error)
    }
  });

} else if (isloggedinn == 0) {
  console.log("Logged inn: False");
    // //////////////////////////
    // False logg inn
    // //////////////////////////

    $.ajax({
      url: 'php_requires/defaultDataretrive_ajax.php',
      type: 'GET',
      datatype: 'json',
      success: (data) => {
        
          // data is json? Get data anyway
          console.log(data);
          var upgrades_from_data = JSON.parse(data);
          // console.log(user_information.biscuit_progress[0].biscuit_count);
          console.log(upgrades_from_data);
          // The second object contains an array

          // Get updates
          upgrades_from_data[0].forEach(element => {
            console.log(element);
            let upgrade_object = {
              id: element.id_upgrades,
              navn: element.upgrade_navn,
              headline: element.upgrade_headline,
              unlocked: false,
              antal: 0,
              value: element.upgrade_value,
              cost: element.upgrade_cost,
              des: element.upgrade_des
            }
            Upgrades.push(upgrade_object);
            orignalupgrade.push(upgrade_object);
          });

          if (page == "index.php" || page == ""){
            Upgrades[0].unlocked = true;
            RefreshUpgradesElem();
            UpdateBiscuitAuto();
            UpdatePrestige();
          }
          console.log(Upgrades);  
      },
      error: (error) => {
        console.error('Error fetching data:', error)
      }
    });
} else {
  console.log("Login error");
}

// Saving progress
  function save_progress(auto_save) {
    var is_autosaving = auto_save;

    console.log("Attempt to save progress and upgrades");
    var save_form = document.createElement("form");
    save_form.method = "POST";
    save_form.action = "php_requires/save_progress_h.php";

    for (var i = 0; i < Upgrades.length; i++) {
      var input = document.createElement("input");
      input.type = "hidden";
      input.name = "upgrades[" + Upgrades[i].id + "]";
      input.value = Upgrades[i].antal;
      save_form.appendChild(input);
    }

    var inputProgress = document.createElement("input");
    inputProgress.type = "hidden";
    inputProgress.name = "biscuit_progress[biscuit_count]";
    inputProgress.value = biscuitCount;
    save_form.appendChild(inputProgress);

    var inputPrestige = document.createElement("input");
    inputPrestige.type = "hidden";
    inputPrestige.name = "biscuit_progress[prestige_count]";
    inputPrestige.value = biscuitprestige;
    save_form.appendChild(inputPrestige);

    if (is_autosaving == true) {
      var auto_save = document.createElement("input");
      auto_save.type = "hidden";
      auto_save.name = "auto_saving";
      auto_save.value = 1;
      save_form.appendChild(auto_save);
    }
 
    document.body.appendChild(save_form);
    save_form.submit();
  }
  // Auto save
  function enable_autosave() {
    setInterval(() => {
      save_progress(true);
    }, 600000); // 600 000 milliseconds = 10 minuetes
  }





// Saving new acquired items
  function save_item(item_object){
    console.log(item_object)
    var save_form = document.createElement("form");
    save_form.method = "POST";
    save_form.action = "php_requires/save_item_h.php";

    var input = document.createElement("input");
    input.type = "hidden";
    input.name = "item[" + item_object.id + "]";
    input.value = 1;
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
