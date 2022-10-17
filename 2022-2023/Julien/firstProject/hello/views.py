from django.shortcuts import render

from hello.models import Article


def index(request):

    articles = Article.objects.all()

    return render(
        request, "index.html", {"param": "complètement vrai", "articles": articles}
    )
