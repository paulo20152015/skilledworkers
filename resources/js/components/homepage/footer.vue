<template>
    <div class="myFooter" id="footer">
        <div class="subFooter">
            <div class="myContainer mainContainer">
                <div>
                    <h2>Reach Us</h2>
                    <span>Mobile Number: 0917 848 5758</span>
                    <span>Address : Macabulos Dr 2300 Tarlac, Tarlac</span>
                </div>
            </div>
            <div class="myContainer mainContainer">
                <div>
                   <h2>Social Media</h2>
                   <a href="https://www.facebook.com/pesotarlaccapitol/">PESO Tarlac City</a>
                </div>
            </div>
        </div>
        <div class="copyright">Copyright 2019-2020</div>
    </div>
</template>
<style scoped>
    .myFooter {
        position: relative;
        width: 100%;
        background-color: #333;
        color: #f1f1f1;
    }

    .myFooter .subFooter {
        width: 100%;
        display: flex;   
        padding: 20px;
    }

    .myFooter .subFooter .myContainer {
        width: 100%;
    }

    .myFooter .subFooter .myContainer div {
        display: flex;
        flex-direction: column;
    }

    .myFooter .copyright {
        padding: 10px;
        background-color: #444;
        text-align: center;
        font-size: 18px;
    }

</style>

