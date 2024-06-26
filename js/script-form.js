// um padrão de boa prática é que os nomes em JS quando composto todo nome que sucede o primeiro sempre vai começar com letra maiúscula.

// mascara imput telefone
Inputmask({
  mask:["(99) 9999-9999", "(99) 99999-9999"]
}).mask(telefone)


// Inputmask({
//   mask:["999.999.999-99"]
// }).mask(cpf)


// Inputmask({
//   mask:["99.999-999"]
// }).mask(cep)

const enviarContato = () => {
  validaCampoVazio(nome)
  validaCampoVazio(email)
  validaCampoVazio(telefone)
  validaCampoVazio(tipo)
  validaCampoVazio(msg)

  //   se todos os campos estao certos, os dados são enviados para backend
  if(nome.value != '' && email.value !='' && telefone.value !=''&& tipo.value !='' && msg.value !=''){
    // aqui os dados são enviados para o backend
    // != corresponde a diferente
    // == corresponde a igual - compara
    // = atribui um valor

    let dados = new FormData(form)
    // criou uma variavel com nome dados, e informou que as informaçoes vao vir do id=form
      fetch('backend/contato.php', {
          // enviar os dados usando a fetch API ('AJAX')
          // ele é uma biblioteca que o navegador interpleta
        method: 'POST',
        body: dados
      }
    )

    .then(response => response.json())
    .then(dados =>{
      // resposta do Backend
      if(dados.STATUS == 0){
        Swal.fire({
          title: 'Atenção',
          text: dados.MSG,
          icon: 'error'
        })
      } else{
        Swal.fire({
          title: 'Atenção',
          text: dados.MSG,
          icon: 'success'
        })
        // se deu certo vai limpar o formulario
        form.reset()
      }
    })
    
  }
}

// função de validar se os campos estão ou não vasios
const validaCampoVazio = (campo) =>{
  if(campo.value == ''){
    campo.style.border = '1px solid red'
  }else{
    campo.style.border = '1px solid #202c73'
  }
}












// abaixo codigo mais completo
// const menuResponsivo = () =>{
//     $('#menu').toggle()
// }

// // arrow function, forma mais correta de escrever uma função
// const enviarContato = () => {

//   validaCampoVazio(nome)
//   validaCampoVazio(email)
//   validaCampoVazio(tipo)

//   if(nome.value != '' && email.value !='' && tipo.value !=''){
//     Swal.fire({
//         title: "Sucesso!",
//         text: `Obrigado, aguarde nosso contato em brebe!`,
//         icon: "success"
//     });
//     let form = document.getElementById('form-contato')

//     form.reset()
//   }
// }

// const validaCampoVazio = (campo) =>{
//     if(campo.value == ''){
//         campo.style.border = '1px solid red'

//         document.getElementById('div-form-alerta').innerHTML = (`
//         <div id="form-alerta">
//             Preencha todos os campos obrigatórios!
//         </div>
//         `)

//     }else{
//         campo.style.border = '1px solid #202c73'
//     }
// }