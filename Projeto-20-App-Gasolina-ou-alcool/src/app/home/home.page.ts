import { Component } from '@angular/core';
import { IonicModule } from '@ionic/angular';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
  standalone: true,
  imports: [IonicModule, FormsModule],
})

export class HomePage {
  
  public precoAlcool: number = 4.30;
  public precoGasolina: number = 5.40;
  public resultado: String = "Resultado";

  calcular(){
    if (this.precoAlcool && this.precoGasolina){
      let res = this.precoAlcool / this.precoGasolina;

      if(res>= 0.7){
        this.resultado = "Melhor abastecer com gasolina";
      }else{
        this.resultado = "Melhor abastecer com álcool"
      }

    }else{
      this.resultado = "Preencha os campos corretamente";
    }
  }

  constructor() {
  }
}
