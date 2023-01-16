import uuid

from django.db import models

from localisation.models import Village, Delegation, SousPrefecture


class Producteur(models.Model):
    class Meta:
        db_table = "tbproducteur"

    genre_list = [
        ("masculin","masculin"),
        ('feminin', "feminin")
    ]
    id = models.BigIntegerField( blank=True, default=0, editable=False)
    uuid = models.UUIDField(unique=True, blank=True, default=None)
    code_producteur = models.CharField(primary_key=True,max_length=15, blank=True, default=None)
    nom = models.CharField(max_length=30, default='')
    photo = models.ImageField(blank=True, default="avatar.jpg", upload_to="avatar",  null=True)
    date_de_naissance = models.CharField(max_length=50, null=True)
    lieu_de_naissance = models.CharField(max_length=50 ,null=True)
    genre = models.CharField(max_length=10, default=",null=True")
    numero_piece = models.CharField(max_length=50)
    contact = models.CharField(max_length=50,null=True)
    cel = models.CharField(max_length=50,null=True)
    email = models.EmailField(max_length=50, blank=True, default="")
    adresse_postale = models.CharField(max_length=50, blank=True, default="")
    taille = models.CharField(max_length=10, default='',null=True)
    pointure = models.CharField(max_length=6, default='',null=True)
    type_piece = models.CharField(max_length=20, default='',null=True)
    nationalite = models.CharField(max_length=50,null=True)
    active = models.IntegerField(default=1, blank=True,null=True)
    supp = models.IntegerField(default=0,null=True)
    id_supp = models.IntegerField(default=0, blank=True,null=True)
    id_creation = models.IntegerField(default=0, blank=True,null=True)
    id_modification = models.IntegerField(default=0, blank=True,null=True)
    date_creation = models.DateTimeField(auto_now_add=True,null=True)
    date_modification = models.DateTimeField(auto_now=True,null=True)
    date_suppression = models.DateTimeField(auto_now=False, auto_created=False,null=True)

    def __str__(self):
        return self.nom + " " + self.prenoms

    def save(self, *args, **kwargs):
        if self.id == 0:
            try:
                self.id = Producteur.objects.latest('id').id + 1
            except Producteur.DoesNotExist:
                self.id = 1

        if self.uuid is None:
            try:
                self.uuid = uuid.uuid4()
            except Exception as e:
                self.uuid = uuid.uuid4()
        super(Producteur, self).save()
