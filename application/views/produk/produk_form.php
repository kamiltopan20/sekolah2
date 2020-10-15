<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="varchar">Nama Produk <?php echo form_error('nama_produk') ?></label>
            <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Nama Produk" value="<?php echo $nama_produk; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Warna <?php echo form_error('warna') ?></label>
            <input type="text" class="form-control" name="warna" id="warna" placeholder="Warna" value="<?php echo $warna; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Kategory Produk <?php echo form_error('kategory') ?></label>
            
            <select name="kategory" class="form-control">
                <option value="<?php echo $kategory ?>"><?php echo $kategory ?></option>
                <option value="aparel">aparel</option>
                <option value="furniture">furniture</option>
              
            </select>
        </div>
        
        <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('produk') ?>" class="btn btn-default">Cancel</a>
    </form>