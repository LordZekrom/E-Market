document.addEventListener('DOMContentLoaded', () => {
    const ofertas = document.querySelectorAll('.ofertas');

    ofertas.forEach(ofertas => {
        ofertas.addEventListener('click', () => {
            ofertas.classList.toggle('expanded');
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const cupons = document.querySelectorAll('.cupons');

    cupons.forEach(cupons => {
        cupons.addEventListener('click', () => {
            cupons.classList.toggle('expanded');
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const categorias = document.querySelectorAll('.categorias');

    categorias.forEach(categorias => {
        categorias.addEventListener('click', () => {
            categorias.classList.toggle('expanded');
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const maisvendidos = document.querySelectorAll('.maisvendidos');

    maisvendidos.forEach(maisvendidos => {
        maisvendidos.addEventListener('click', () => {
            maisvendidos.classList.toggle('expanded');
        });
    });
});
