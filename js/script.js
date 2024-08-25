let userBox = document.querySelector('.header .flex .account-box');

document.querySelector('#user-btn').onclick = () =>{
    userBox.classList.toggle('active');
    navbar.classList.remove('active');
}

let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    userBox.classList.remove('active');
}

window.onscroll = () =>{
    userBox.classList.remove('active');
    navbar.classList.remove('active');
}

document.addEventListener('DOMContentLoaded', () => {
    const provinceSelect = document.getElementById('province');
    const citySelect = document.getElementById('city');
    const brgySelect = document.getElementById('brgy');

//List
    const brgyy = {
        Cavite: {
            Cavite_City : ['Brgy A'],
            Silang : ['Brgy b'],
            Maragondon : ['Brgy C'],
            General_Emilio_Aguinaldo : ['Brgy D'],
            Magallanes : ['Brgy E'],
            Bacoor : ['Brgy F'],
            Dasma : ['Brgy G'],
            Imus : ['Brgy H'],
            Mendez : ['Brgy I'],
            General_Trias : ['Brgy J'],
            Kawit : ['Brgy K'],
            Alfonso : ['Brgy L'],
            Noveleta : ['Brgy M'],
            Indang : ['Brgy N'],
            Amadeo : ['Brgy O'],
            General_Mariano_Alvarez : ['Brgy P'],
            Trece_Martires : ['Brgy Lapidario','Brgy Hugo Perez'],
            Tagaytay : ['Brgy Q'],
            Carmona : ['Brgy R'],
            Ternate : ['Brgy S'],
            Tanza : ['Brgy T'],
            Naic : ['Brgy U'],
            Rosario : ['Brgy V'],
            San_Pedro : ['Brgy W'],
            Laurel : ['Brgy X']
        },
        laguna: {
            Santa_Cruz : ['Brgy A'],
            Los_Baños : ['Brgy B'],
            San_Pablo : ['Brgy C'],
            Pilillia : ['Brgy D'],
            Santa_Rosa : ['Brgy E']
        },
        batangas: {
            Batangas_City : ['Brgy A']
        },
        rizal: {
            Rizal_City : ['Brgy A']
        },
        quezon: {
            Quezon_City : ['Brgy A']
        }
    };

      function updateOptions(selectElement, options) { 
      selectElement.innerHTML = '<option value="">Select</option>'; options.forEach(option => { const opt = document.createElement('option');
        opt.value = option; opt.textContent = option; selectElement.appendChild(opt);
         }); 
}    
            
      provinceSelect.addEventListener('change', () => {
        const province = provinceSelect.value;
        const cities = Object.keys(brgyy[province] || {});
        updateOptions(citySelect, cities);
        brgySelect.innerHTML = '<option value="">Select City</option>';
    });

      citySelect.addEventListener('change', () => {
        const province = provinceSelect.value;
        const city = citySelect.value;
        const brg = brgyy[province]?.[city] || [];
        updateOptions(brgySelect, brg);
    });
});


