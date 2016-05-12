    <ul class="products">
        <li>
            <a href="#" class="item">
                <?php echo img('assets/imagenes/shirt1.gif');?>
                <div>
                    <p hidden>1</p>
                    <p>Balloon</p>
                    <p>Precio:$25</p>
                </div>
            </a>
        </li>
        <li>
            <a href="#" class="item">
                <?php echo img('assets/imagenes/shirt2.gif');?>
                <div>
                    <p hidden>2</p>
                    <p>Feeling</p>
                    <p>Precio:$25</p>
                </div>
            </a>
        </li>
        <li>
            <a href="#" class="item">
                <?php echo img('assets/imagenes/shirt3.gif');?>
                <div>
                    <p hidden>3</p>
                    <p>Elephant</p>
                    <p>Precio:$25</p>
                </div>
            </a>
        </li>
        <li>
            <a href="#" class="item">
                <?php echo img('assets/imagenes/shirt4.gif');?>
                <div>
                    <p hidden>4</p>
                    <p>Stamps</p>
                    <p>Precio:$25</p>
                </div>
            </a>
        </li>
        <li>
            <a href="#" class="item">
                <?php echo img('assets/imagenes/shirt5.gif');?>
                <div>
                    <p hidden>5</p>
                    <p>Monogram</p>
                    <p>Precio:$25</p>
                </div>
            </a>
        </li>
        <li>
            <a href="#" class="item">
                <?php echo img('assets/imagenes/shirt6.gif');?>
                <div>
                    <p hidden>6</p>
                    <p>Rolling</p>
                    <p>Precio:$25</p>
                </div>
            </a>
        </li>
    </ul>
    <div class="cart">
        <?php echo heading('Carro de Compras');?>
        <div style="background:#fff">
        <table id="cartcontent" fitColumns="true" style="width:300px;height:auto;">
            <thead>
                <tr>
                    <th field="name" width=140>Nombre</th>
                    <th field="quantity" width=60 align="right">Cantidad</th>
                    <th field="price" width=60 align="right">Precio</th>
                </tr>
            </thead>
        </table>
        </div>
        <p class="total">Total: $0</p>
        <?php echo heading('Arrastra aquí para agregar al carro',2);?>
        <a class="easyui-linkbutton" onclick="comprar()">Comprar</a>
    </div>