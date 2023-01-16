from django.contrib.auth.models import User
from django.db import models

from localisation.models import Delegation
from localisation.models import Agent


class Historiqueagent(models.Model):
    class Meta:
        db_table = "tb_histo_agent"

    id = models.BigIntegerField(primary_key=True, blank=True, default=0)
    user = models.OneToOneField(User, on_delete=models.CASCADE)
    matricule = models.CharField(max_length=15, db_column="agent_matricule")
    nom = models.CharField(max_length=30)
    prenoms = models.CharField(max_length=100)
    email = models.EmailField()
    contact = models.CharField(max_length=36, blank=True, default="")
    login = models.CharField(max_length=30, blank=True, default="")
    mot_de_passe = models.CharField(max_length=30, blank=True, default="")
    contact = models.TextField(blank=True, default="")
    photo = models.ImageField(blank=True, default="avatar.jpg", upload_to='avatar')
    numero_cni = models.CharField(max_length=30, blank=True, default="")
    delegation = models.ForeignKey(Delegation, on_delete=models.DO_NOTHING)
    delegation_code = models.CharField(max_length=15, blank=True, default='')
     agent = models.ForeignKey(Agent, on_delete=models.DO_NOTHING)
      id_agent = models.BigIntegerField(blank=True, default='')
    # fonction = models.ManyToManyField(Fonction, through='Role')

    est_admin = models.IntegerField(default=0)
    est_agent = models.IntegerField(default=0)
    est_dg = models.IntegerField(default=0)
    est_dr = models.IntegerField(default=0)
    active = models.IntegerField(default=1, db_column='statut')

    supp = models.IntegerField(default=0)
    id_sup = models.IntegerField(default=0, blank=True)
    id_creation = models.IntegerField(default=0, blank=True)
    id_modification = models.IntegerField(default=0, blank=True)

    date_creation = models.DateTimeField(auto_now_add=True)
    date_modification = models.DateTimeField(auto_now=True)
    date_suppression = models.DateTimeField(auto_now=False, auto_created=False, blank=True, default='')

    def __str__(self):
        return self.nom +" "+ self.prenoms

    def save(self, *args, **kwargs):
        if self.id == 0:
            try:
                self.id = Agent.objects.latest('id').id + 1
            except Agent.DoesNotExist:
                self.id = 1

        super(Agent, self).save()


def createAgentProfil(sender, instance, created, *args, **kwargs):
    pass

""" 
class Fonction(models.Model):
    class Meta:
        db_table = "tb_fonction"

    id = models.BigIntegerField(primary_key=True, default=None, blank=True)
    libelle = models.CharField(max_length=15)
    description = models.CharField(max_length=100)

    id_creation = models.IntegerField(null=True, blank=True)
    id_modification = models.IntegerField(null=True, blank=True)

    date_creation = models.DateTimeField(auto_now_add=True)
    date_modification = models.DateTimeField(auto_now=True)

    def __str__(self):
        return "fonction : " + self.libelle

    def save(self, *args, **kwargs):
        if self.id is None:
            try:
                self.id = Fonction.objects.latest('id').id+1
            except Fonction.DoesNotExist:
                self.id = 1
        super(Fonction, self).save()

"""

""" 
class Role(models.Model):
    class Meta:
        db_table = "tb_role"

    id = models.BigIntegerField(primary_key=True, blank=True,default=None)
    agent = models.ForeignKey(Agent, on_delete=models.DO_NOTHING)
    fonction = models.ForeignKey(Fonction, on_delete=models.CASCADE)

    id_sup = models.IntegerField(null=True, blank=True)
    id_creation = models.IntegerField(null=True, blank=True)
    id_modification = models.IntegerField(null=True, blank=True)

    date_creation = models.DateTimeField(auto_now_add=True)
    date_modification = models.DateTimeField(auto_now=True)
    date_suppression = models.DateTimeField(auto_now=False, auto_created=False)

    def __str__(self):
        return self.agent.nom + ' est ' + self.fonction.libelle

    def save(self, *args, **kwargs):
        if self.id is None:
            try:
                self.id = Role.objects.latest('id').id + 1
            except Role.DoesNotExist:
                self.id = 1
        super(Role, self).save()
        
"""