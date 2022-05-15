import { Component, OnInit } from '@angular/core';
import { Article } from 'src/app/model/Article';
import { ArticleService } from 'src/app/services/article.service';

@Component({
  selector: 'app-second-section',
  templateUrl: './second-section.component.html',
  styleUrls: ['./second-section.component.css']
})
export class SecondSectionComponent implements OnInit {
  articles: Article[]=[]
  constructor(private _serviceArticle:ArticleService) { }

  ngOnInit(): void {
    this.getArticle()
  }

  getArticle(){
    this._serviceArticle.getArticles().subscribe(reponse=>{
      this.articles=reponse
      console.log(reponse)
    })
  }

}
