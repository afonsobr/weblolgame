function buildPage() {
    $("#divPage").load("load/game.php", function (response, status, xhr) {
        if (status == "error") {
            var msg = "Sorry but there was an error: ";
            $("#error").html(msg + xhr.status + " " + xhr.statusText);
        }
    });
    loadPart("sidebar", "sidebar");
    update();
    loadPart("controlBar", "controlbar");
}

function loadPart(divId, linkPage) {
    $("#" + divId).load("load/" + linkPage + ".php");
}

function navMenu(v1) {
    switch (v1) {
        case 0:
            $("#lobby").show(250);
            $("#profile").hide(250);
            $("#partida").hide(250);
            $("#store").hide(250);
            $("#inventory").hide(250);
            $("#prizes").hide(250);

            $("#lobbyNav").addClass("active");
            $("#profileNav").removeClass();
            $("#partidaNav").removeClass();
            $("#storeNav").removeClass();
            $("#inventoryNav").removeClass();
            $("#prizesNav").removeClass();
            break;
        case 1:
            $("#lobby").hide(250);
            $("#profile").show(250);
            $("#partida").hide(250);
            $("#store").hide(250);
            $("#inventory").hide(250);
            $("#prizes").hide(250);

            $("#lobbyNav").removeClass();
            $("#profileNav").addClass("active");
            $("#partidaNav").removeClass();
            $("#storeNav").removeClass();
            $("#inventoryNav").removeClass();
            $("#prizesNav").removeClass();
            break;
        case 2:
            $("#lobby").hide(250);
            $("#profile").hide(250);
            $("#partida").show(250);
            $("#store").hide(250);
            $("#inventory").hide(250);
            $("#prizes").hide(250);

            $("#lobbyNav").removeClass();
            $("#profileNav").removeClass();
            $("#partidaNav").addClass("active");
            $("#storeNav").removeClass();
            $("#inventoryNav").removeClass();
            $("#prizesNav").removeClass();
            break;
        case 3:
            $("#lobby").hide(250);
            $("#profile").hide(250);
            $("#partida").hide(250);
            $("#store").show(250);
            $("#inventory").hide(250);
            $("#prizes").hide(250);

            $("#lobbyNav").removeClass();
            $("#profileNav").removeClass();
            $("#partidaNav").removeClass();
            $("#storeNav").addClass("active");
            $("#inventoryNav").removeClass();
            $("#prizesNav").removeClass();
            break;
        case 4:
            $("#lobby").hide(250);
            $("#profile").hide(250);
            $("#partida").hide(250);
            $("#store").hide(250);
            $("#inventory").show(250);
            $("#prizes").hide(250);

            $("#lobbyNav").removeClass();
            $("#profileNav").removeClass();
            $("#partidaNav").removeClass();
            $("#storeNav").removeClass();
            $("#inventoryNav").addClass("active");
            $("#prizesNav").removeClass();
            break;
        case 5:
            $("#lobby").hide(250);
            $("#profile").hide(250);
            $("#partida").hide(250);
            $("#store").hide(250);
            $("#inventory").hide(250);
            $("#prizes").show(250);

            $("#lobbyNav").removeClass();
            $("#profileNav").removeClass();
            $("#partidaNav").removeClass();
            $("#storeNav").removeClass();
            $("#inventoryNav").removeClass();
            $("#prizesNav").addClass("active");
            break;
    }
}

function mainSave() {
    $.ajax({
        url: "scripts/php/mainSave.php",
        type: "POST",
        data: {
            mainLane: $("#mainLaneSelect").val(),
            mainChamp: $("#mainChampSelect").val(),
            playerID: $("#playerid").val()
        },
        dataType: 'json',
        success: function (data) {
            loadPart("sidebar", "sidebar");
            if (data == 3) {
                swal("Opa!", "Você não pode alterar essas informações enquanto sua partida está em andamento!", "error");
            }
        }
    });
}

function startGame(type) {
    $.ajax({
        url: "scripts/php/startGame.php",
        type: "POST",
        data: {
            gameType: type,
        },
        dataType: 'json',
        success: function (data) {
            if (data == 0) {} else if (data == 1) { //NORMAL
                loadPart("sidebar", "sidebar");
                navMenu(0);
                $("#navBar").toggle(500);
                $("#timeDiv").show(1000);
                $("#selectDiv").hide(1000);
            } else if (data == 2) { //RANKED
                loadPart("sidebar", "sidebar");
                navMenu(0);
                $("#navBar").toggle(500);
                $("#timeDiv").hide(1000);
                $("#selectDiv").hide(1000);
                $("#queueDiv").show(1000);
                checkRanked();
            } else if (data == 3) {
                alert("Você já está em uma partida!");
            } else if (data == 4) {
                swal({
                    title: "Energia Insuficiente!",
                    text: "Você não tem <span class='glyphicon glyphicon-flash' aria-hidden='true'></span> Energia suficiente para jogar esta partida!",
                    html: true
                });
            } else if (data == 5) {
                swal({
                    title: "Saiu da Fila!",
                    text: "Você saiu da fila :(<br>Tá foda de achar alguém pra jogar hj?",
                    html: true
                });
                clearInterval(refreshIntervalId);
                clearInterval(myTimer2);
                $("#divPage").load("load/game.php");
                loadPart("sidebar", "sidebar");
                document.title = ".:WebLoL:.";
            }
        }
    });
}

function finishGame() {
    $.ajax({
        url: "scripts/php/finishGame.php",
        type: "POST",
        data: {},
        dataType: 'json',
        success: function (data) {
            loadPart("sidebar", "sidebar");
            if (data[1] == 1) {
                var resultado = "<img src='images/layout/vic.png' class='matchResult'>";
            } else {
                var resultado = "<img src='images/layout/def.png' class='matchResult'>";
            }
            buildPage();
            swal({
                title: resultado,
                text: data[0],
                html: true,
                showCancelButton: false,
                confirmButtonColor: "#AEDEF4",
                confirmButtonText: "OK!",
                closeOnConfirm: true,

            }, function () {});
            if (data == 0) {} else if (data == 1 || data == 2) {
                loadPart("sidebar", "sidebar");
            } else if (data == 3) {
                alert("Você já está em uma partida!");
            }
        }
    });
}



function searchRankedTeam() {
    $.ajax({
        url: "scripts/php/f_startRanked.php",
        type: "POST",
        data: {},
        dataType: 'json',
        success: function (data) {
            if (data == 0) {
                swal("Ops!", "Level insuficiente!", "error");
            } else if (data == 1) {
                swal("Partida Iniciada!", "Encontrou um time, e agora, vm clan!", "success");
                loadingScreen();
            } else if (data == 2) {
                swal("Ops!", "Não achamos jogadores suficientes para a partida! Tente novamente mais tarde.", "error");
            }
            $("#divPage").load("load/game.php");
            loadPart("sidebar", "sidebar");

        }
    });
}

function whoInQ() {
    $.ajax({
        url: "scripts/php/f_whoInQ.php",
        type: "POST",
        data: {},
        dataType: 'json',
        success: function (data) {
            swal("", data, "");
        }
    });
}

function checkRanked() {
    $.ajax({
        url: "scripts/php/f_checkRanked.php",
        type: "POST",
        data: {},
        dataType: 'json',
        success: function (data) {
            if (data == 1) {
                setTimeout(function () { //TA NA FILA AINDA
                    checkRanked();
                    $.ajax({
                        url: "scripts/php/f_startRanked.php",
                        type: "POST",
                        data: {},
                        dataType: 'json',
                        success: function (data) {
                            if (data == 0) { //level insuficiente
                            } else if (data == 1) {
                                location.reload();
                            } else if (data == 2) { //jogadores insuficientes
                            }
                        }
                    });
                }, 10000);
            } else if (data == 0) { //ENTROU NA PARTIDA RANKED
                location.reload();
            } else {

            }
        }
    });
}

function finishRanked() {
    $.ajax({
        url: "scripts/php/f_finishRanked.php",
        type: "POST",
        data: {},
        dataType: 'json',
        success: function (data) {
            loadPart("sidebar", "sidebar");
            if (data[1] == 1) {
                var resultado = "<img src='images/layout/vic.png' class='matchResult'>";
            } else {
                var resultado = "<img src='images/layout/def.png' class='matchResult'>";
            }
            buildPage();
            swal({
                title: resultado,
                text: data[0],
                html: true,
                showCancelButton: false,
                confirmButtonColor: "#AEDEF4",
                confirmButtonText: "OK!",
                closeOnConfirm: true,

            }, function () {
                matchResult(data[2]);
            });
            if (data == 0) {} else if (data == 1 || data == 2) {
                loadPart("sidebar", "sidebar");
            } else if (data == 3) {
                alert("Você já está em uma partida!");
            }
        }
    });
}

function loadingScreen() {
    $(".loadingRanked").show();
    $.ajax({
        url: "scripts/php/f_loadingScreen.php",
        type: "POST",
        data: {},
        dataType: 'json',
        success: function (data) {
            $("#player1Nick").html(data[0]);
            $("#player2Nick").html(data[1]);
            $("#player3Nick").html(data[2]);
            $("#player4Nick").html(data[3]);
            $("#player5Nick").html(data[4]);
            $("#player6Nick").html(data[5]);
            $("#player7Nick").html(data[6]);
            $("#player8Nick").html(data[7]);
            $("#player9Nick").html(data[8]);
            $("#player10Nick").html(data[9]);
            $("#iconp1").css('background-image', 'url(images/icons/' + data[10] + '.jpg)');
            $("#iconp2").css('background-image', 'url(images/icons/' + data[11] + '.jpg)');
            $("#iconp3").css('background-image', 'url(images/icons/' + data[12] + '.jpg)');
            $("#iconp4").css('background-image', 'url(images/icons/' + data[13] + '.jpg)');
            $("#iconp5").css('background-image', 'url(images/icons/' + data[14] + '.jpg)');
            $("#iconp6").css('background-image', 'url(images/icons/' + data[15] + '.jpg)');
            $("#iconp7").css('background-image', 'url(images/icons/' + data[16] + '.jpg)');
            $("#iconp8").css('background-image', 'url(images/icons/' + data[17] + '.jpg)');
            $("#iconp9").css('background-image', 'url(images/icons/' + data[18] + '.jpg)');
            $("#iconp10").css('background-image', 'url(images/icons/' + data[19] + '.jpg)');
            $("#championp1").css('background-image', 'url("images/champions2/' + data[20] + '.jpg")');
            $("#championp2").css('background-image', 'url("images/champions2/' + data[21] + '.jpg")');
            $("#championp3").css('background-image', 'url("images/champions2/' + data[22] + '.jpg")');
            $("#championp4").css('background-image', 'url("images/champions2/' + data[23] + '.jpg")');
            $("#championp5").css('background-image', 'url("images/champions2/' + data[24] + '.jpg")');
            $("#championp6").css('background-image', 'url("images/champions2/' + data[25] + '.jpg")');
            $("#championp7").css('background-image', 'url("images/champions2/' + data[26] + '.jpg")');
            $("#championp8").css('background-image', 'url("images/champions2/' + data[27] + '.jpg")');
            $("#championp9").css('background-image', 'url("images/champions2/' + data[28] + '.jpg")');
            $("#championp10").css('background-image', 'url("images/champions2/' + data[29] + '.jpg")');
        }
    });
}

var myTimer2;
var refreshIntervalId;

function startTimer(duration) {
    clearInterval(refreshIntervalId);
    clearInterval(myTimer2);
    var timer = duration,
        minutes, seconds;
    if (duration != 0) {
        refreshIntervalId = setInterval(function () {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            document.title = minutes + ":" + seconds;
            document.querySelector('#time1').textContent = minutes + ":" + seconds;
            document.querySelector('#time3').textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                timer = duration;
                clearInterval(refreshIntervalId);
                document.title = "PARTIDA FINALIZADA";
                swal({
                    title: "Sua partida terminou!",
                    text: "Vamos ver os resultados da partida?",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#AEDEF4",
                    confirmButtonText: "OK!",
                    closeOnConfirm: false
                }, function () {
                    location.reload();
                });


            }
        }, 1000);
    }
}

function startTimer2(duration) {
    var timer = duration,
        minutes, seconds;
    clearInterval(refreshIntervalId);
    clearInterval(myTimer2);
    if (duration >= 0) {
        myTimer2 = setInterval(function () {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            document.title = "Fila: " + minutes + ":" + seconds;
            document.querySelector('#time2').textContent = minutes + ":" + seconds;

            if (++timer > 3000) {
                clearInterval(myTimer2);
                timer = duration;
                startGame("closeQ");
                document.title = ".:WebLoL:.";
            }
        }, 1000);
    }
}


function storeBuy(product) {
    $.ajax({
        url: "scripts/php/store.php",
        type: "POST",
        data: {
            product: product
        },
        dataType: 'json',
        success: function (data) {
            if (data == 2) {
                swal({
                    title: "IP/RP Insuficiente!",
                    text: "Você não tem <img class='iprpImg' src='images/layout/IpPoints.png'> IP ou <img class='iprpImg' src='images/layout/RpPoints.png'> RP suficiente para comprar isso!",
                    html: true
                });
            } else if (data == 1) {
                swal("Compra realizada!", "", "success");
                $("#divPage").load("load/game.php");
                loadPart("sidebar", "sidebar");
            } else if (data == 3) {
                swal("Oops!", "Você já comprou esse produto!", "error");
            }
        }
    });
}

function toggleButton(id) {
    $('#' + id).toggle();
}

function rankChamp() {
    var champToLoadRank = $("#rankChampShow").val();
    $("#championRankLoad").load("load/rank_ChampionRank.php", {
        "champion": champToLoadRank
    });
}


function dailyPrize() {
    $.ajax({
        url: "scripts/php/f_dailyPrize.php",
        type: "POST",
        data: {},
        dataType: 'json',
        success: function (data) {
            $("#dailyPrizeButton").html(data);
            loadPart("sidebar", "sidebar");
        }
    });
}

function promoCode() {
    var promoCode = $("#promoCode").val();
    $.ajax({
        url: "scripts/php/f_promoCode.php",
        type: "POST",
        data: {
            promoCode: promoCode,
        },
        dataType: 'json',
        success: function (data) {
            $("#promoCodeResult").html(data);
            loadPart("sidebar", "sidebar");
        }
    });
}

function matchResult(matchID) {
    $.post('matchResult.php', {
        matchID: matchID
    }, function (result) {
        WinId = window.open('', 'KAPA', '');
        WinId.document.open();
        WinId.document.write(result);
        WinId.document.close();
    });
}

function aposta(bet) {
    $.ajax({
        url: "scripts/php/game_bet.php",
        type: "POST",
        data: {
            bet: bet
        },
        dataType: 'json',
        success: function (data) {
            $("#betResult").html(data);
            loadPart("sidebar", "sidebar");
        }
    });
}

function work(type) {
    $.ajax({
        url: "scripts/php/game_work.php",
        type: "POST",
        data: {
            tipo: type
        },
        dataType: 'json',
        success: function (data) {
            if (data == 1) {
                swal("TRABSON!", "Trabalhou, meu parça!", "success");
                loadPart("sidebar", "sidebar");
                $("#divPage").load("load/game.php");
            } else {
                swal("Opa!", "Você não está em condições para trabalhar!", "error");
            }
        }
    });
}

function moneyBuy(product) {
    $.ajax({
        url: "scripts/php/game_buyWithMoney.php",
        type: "POST",
        data: {
            product: product
        },
        dataType: 'json',
        success: function (data) {
            if (data[0] == 1) {
                swal({
                    title: "Compra Realizada!",
                    text: data[1],
                    type: "success",
                    html: true
                });
                loadPart("sidebar", "sidebar");
                $("#divPage").load("load/game.php");
            } else if (data[0] == 0) {
                swal("Opa!", "Dinheiro insuficiente!", "error");
            } else if (data[0] == 2) {
                swal("Opa!", "EloJob só até o Diamante!", "error");
            }
        }
    });
}

function chatToggle() {
    if ($("#myonoffswitch").prop("checked")) {
        showOption(0);
        $('#chatDiv').show();
    } else {
        showOption(1);
        $('#chatDiv').hide();
    }
}

function showOption(t) {
    $("#chatDivLoad").load("load/chat.php", {
        "option": t
    });
}
